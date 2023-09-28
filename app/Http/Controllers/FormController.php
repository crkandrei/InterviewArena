<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Question;
use App\Models\Questioner;
use App\Models\UserAnswer;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Exception\ClientException;

class FormController extends Controller
{
    private Client $client;

    public const NUMBER_OF_QUESTIONS = 5;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function submit(Request $request): JsonResponse
    {
        $data = $request->input('data');
        $prompt = $this->generatePrompt($request->input('type'), $data);

        try {
            $content = $this->requestOpenAI($prompt, 1.3);
            $questions = array_map('trim', preg_split('/\n+/', $content, -1, PREG_SPLIT_NO_EMPTY));

            $questioner = new Questioner();
            $questioner->user_id = auth()->id();
            $questioner->prompt = $prompt;
            $questioner->save();

            $createdQuestions = [];

            foreach ($questions as $question) {
                $createdQuestions[] = Question::create([
                    'questioner_id' => $questioner->id,
                    'category' => $data['domainField'],
                    'content' => $question,
                ])->toArray();

            }

            return response()->json(['questions' => $createdQuestions]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function submitAnswers(Request $request): JsonResponse
    {
        $request->validate([
            'questions' => 'required|array',
            'answers' => 'required|array'
        ]);


        $questions = $request->input('questions');
        $answers = $request->input('answers');

        $prompt = $this->generateFeedbackPrompt($questions, $answers);

        try {
            $feedbackContent = $this->requestOpenAI($prompt, 0.6);

            $feedbackArray = json_decode($feedbackContent, true);

            $this->saveAnswersAndFeedback($questions, $answers, $feedbackArray);

            return response()->json(['feedbacks' => $feedbackArray['feedbacks'], 'scores' => $feedbackArray['scores']]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function generatePrompt(string $type, array $data): string
    {
        if ($type == 'profile') {
            return "I want you to Generate " . self::NUMBER_OF_QUESTIONS . " interview questions for a {$data['domainField']} professional with {$data['experienceLevel']} years of experience, specializing in {$data['technology']}. The questions must be technical and I want you to send me only the questions not other words.";
        }
        return "Generate 15 interview questions for a candidate applying for the following job description: {$data['jobDescription']}";
    }

    private function generateFeedbackPrompt(array $questions, array $answers): string
    {
        $prompt = "I am submitting technical interview questions and their given answers. For each, please provide feedback and the correct answer and how should be the response, and assign a score from 1 to 10 (10 being a very good answer). Ensure the feedback is concise and consistent.\n\n";

        foreach ($questions as $index => $question) {
            $number = $index + 1;
            $prompt .= "# Question {$number}: \n{$question['content']}\n# Answer {$number}: \n{$answers[$index]}\n\n";
        }

        $prompt .= "Please do not add new lines in the response. Provide feedback for each answer in the following JSON format: \n{\n  \"feedbacks\": {\n    \"1\": \"feedback and correct answer for question 1.\", \n    \"2\": \"feedback and correct answer for question 2 .\"\n  },\n  \"scores\": {\n    \"1\": score for first answer, \n    \"2\": score for second answer\n  }\n, and so on for every question}";

        return $prompt;
    }

    private function requestOpenAI(string $prompt, float $temp): string
    {
        try {
            $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('OPEN_AI_API_KEY')
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [['role' => 'user', 'content' => $prompt]],
                    'temperature' => $temp,
                    'max_tokens' => 500
                ]
            ]);
            $body = json_decode($response->getBody(), true);

            return $body['choices'][0]['message']['content'];
        } catch (ClientException $e) {
            throw new \Exception($e->getResponse()->getBody()->getContents());
        }
    }

    private function saveAnswersAndFeedback(array $questions, array $answers, array $feedbackArray)
    {
        foreach ($questions as $index => $question) {
            $createdFeedback = Feedback::create([
                 'content' => $feedbackArray['feedbacks'][$index + 1],
                  'score' => $feedbackArray['scores'][$index + 1],
                ]);

            UserAnswer::create([
                'question_id' => $question['id'],
                'user_id' => auth()->id(),
                'answer_content' => $answers[$index],
                'feedback_id' => $createdFeedback->id
            ]);

        }
    }
}
