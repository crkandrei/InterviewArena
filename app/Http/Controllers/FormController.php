<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submit(Request $request)
    {
        $type = $request->input('type');
        $data = $request->input('data');

        if($type == 'profile'){
            $domain = $data['domainField'];
            $experience_level = $data['experienceLevel'];
            $technology = $data['technology'];

            $prompt = "I want you to Generate 15 interview questions for a {$domain} professional with {$experience_level} years of experience, specializing in {$technology}. The questions must be technical and I want you to send me only the questions not other words.";
        }else{

            $job_description = $data['jobDescription'];
            $prompt = "Generate 15 interview questions for a candidate applying for the following job description: {$job_description}";

        }
        $client = new Client();

        try{
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.env('OPEN_AI_API_KEY')
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 1.3,
                    'max_tokens' => 500 // adjust as needed
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $responseBody = $e->getResponse()->getBody()->getContents();
            dd($responseBody);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $body = json_decode($response->getBody(), true);


        // Extracting content from the response
        $content = $body['choices'][0]['message']['content'];
        dd($content);
        // Splitting the content into individual questions
        $questions = preg_split('/\?\s+/', $content, -1, PREG_SPLIT_NO_EMPTY);

        // Trimming each question
        $questions = array_map('trim', $questions);



        // Returning the questions as a JSON response
        return response()->json(['questions' => $questions]);
    }
}
