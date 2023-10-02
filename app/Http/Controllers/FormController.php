<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitAnswersRequest;
use App\Repositories\FeedbackRepository;
use App\Repositories\QuestionRepository;
use App\Services\OpenAIService;
use App\Services\PromptService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class FormController extends Controller
{
    private OpenAIService $openAIService;
    private QuestionRepository $questionRepository;
    private FeedbackRepository $feedbackRepository;
    private PromptService $promptService;

    public const NUMBER_OF_QUESTIONS = 5;

    public function __construct(
        OpenAIService $openAIService,
        QuestionRepository $questionRepository,
        FeedbackRepository $feedbackRepository,
        PromptService $promptService
    ) {
        $this->openAIService = $openAIService;
        $this->questionRepository = $questionRepository;
        $this->feedbackRepository = $feedbackRepository;
        $this->promptService = $promptService;
    }

    public function submit(Request $request): JsonResponse
    {
        $data = $request->input('data');
        $prompt = $this->generatePrompt($request->input('type'), $data);

        try {
            DB::beginTransaction();

            $content = $this->openAIService->request($prompt, 1.3);
            $questions = array_map('trim', preg_split('/\n+/', $content, -1, PREG_SPLIT_NO_EMPTY));

            $questioner = $this->questionRepository->createQuestioner(auth()->id(), $prompt);

            $createdQuestions = [];

            foreach ($questions as $question) {
                $createdQuestions[] = $this->questionRepository->createQuestion($questioner->id, $data['domainField'], $question);
            }

            DB::commit();

            return response()->json(['questions' => $createdQuestions]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function submitAnswers(SubmitAnswersRequest $request): JsonResponse
    {
        $questions = $request->input('questions');
        $answers = $request->input('answers');

        $prompt = $this->generateFeedbackPrompt($questions, $answers);

        try {
            $feedbackContent = $this->openAIService->request($prompt, 0.6);

            $feedbackArray = json_decode($feedbackContent, true);

            $this->saveAnswersAndFeedback($questions, $answers, $feedbackArray);

            return response()->json(['feedbacks' => $feedbackArray['feedbacks'], 'scores' => $feedbackArray['scores']]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function generatePrompt(string $type, array $data): string
    {
        return $this->promptService->generatePrompt($type, $data);
    }

    private function generateFeedbackPrompt(array $questions, array $answers): string
    {
        return $this->promptService->generateFeedbackPrompt($questions, $answers);
    }

    private function saveAnswersAndFeedback(array $questions, array $answers, array $feedbackArray)
    {
        try {
            DB::beginTransaction();

            foreach ($questions as $index => $question) {
                $this->feedbackRepository->createFeedbackAndUserAnswer($question, $answers[$index], $feedbackArray, $index);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
