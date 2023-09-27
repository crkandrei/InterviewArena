<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Exception\ClientException;

class FormController extends Controller
{
    private Client $client;

    public const NUMBER_OF_QUESTIONS = 2;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function submit(Request $request): JsonResponse
    {
        $data = $request->input('data');
        $prompt = $this->generatePrompt($request->input('type'), $data);

        try {
            $content = $this->requestOpenAI($prompt);
            $questions = array_map('trim', preg_split('/\n+/', $content, -1, PREG_SPLIT_NO_EMPTY));
            return response()->json(['questions' => $questions]);
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
            $feedbackContent = $this->requestOpenAI($prompt);
            return response()->json(['feedback' => $feedbackContent]);
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
        $prompt = "I will give you some technical questions and answers from an interview and I want you to give me feedback and a perfect answer (Exactly how should I respond) and a mark from 1 to 10 (10 being a very good answer) for each answer individually. These are the questions and answers. I WILL DELIMIT EACH QUESTION ANSWER BOX WITH # ";
        foreach ($questions as $index => $question) {
            $prompt .= "Question: {$question} # Answer: {$answers[$index]} # ";
        }
        return $prompt . '.Please provide feedback for each answer in the following format: {"question_number": "feedback. perfect answer. mark"}.';
    }

    private function requestOpenAI(string $prompt): string
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
                    'temperature' => 1.3,
                    'max_tokens' => 500
                ]
            ]);
            $body = json_decode($response->getBody(), true);
            return $body['choices'][0]['message']['content'];
        } catch (ClientException $e) {
            throw new \Exception($e->getResponse()->getBody()->getContents());
        }
    }
}
