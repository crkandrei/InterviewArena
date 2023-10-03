<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use App\Services\PromptService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Repositories\QuestionRepository;
use App\Repositories\FeedbackRepository;
use App\Http\Requests\SubmitAnswersRequest;
use Illuminate\Support\Facades\Log;


class FormController extends Controller
{
    private const MAX_ATTEMPTS = 5;
    private OpenAIService $openAIService;
    private QuestionRepository $questionRepository;
    private FeedbackRepository $feedbackRepository;
    private PromptService $promptService;

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
        $attempt = 0;

        while ($attempt <= self::MAX_ATTEMPTS) {
            try {
                $feedbackContent = $this->openAIService->request($prompt, 0.6);

                $feedbackArray = json_decode($feedbackContent, true);

                if ($feedbackArray !== null) {
                    $this->saveAnswersAndFeedback($questions, $answers, $feedbackArray);
                    return response()->json(['feedbacks' => $feedbackArray['feedbacks'], 'scores' => $feedbackArray['scores']]);
                }

                $attempt++;
                if ($attempt >= self::MAX_ATTEMPTS) {
                    return response()->json(['error' => 'We have a problem with the AI'], 500);
                }
                sleep(1);

            } catch (\Exception $e) {
                Log::error("Attempt $attempt failed: " . $e->getMessage()); // Logging the error
                return response()->json(['error' => $e->getMessage()], 500);
            }
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
