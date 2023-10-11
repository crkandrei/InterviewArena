<?php

namespace App\Services;

class PromptService
{
    public const TYPE_PROFILE = 'profile';
    public const TYPE_JOB_DESCRIPTION = 'job-description';
    public const NUMBER_OF_QUESTIONS = 4;

    public function generatePrompt(string $type, array $data): string
    {
        $technologies = implode(', ', $data['technology']);

        if ($type == self::TYPE_PROFILE) {
            return "I want you to Generate " . self::NUMBER_OF_QUESTIONS .
                " interview questions for a {$data['domainField']} professional with {$data['experienceLevel']} years of experience, specializing in : {$technologies}. " .
                "The questions must be technical and I want you to send me only the questions not other words.";
        }
        return "I want you to Generate " . self::NUMBER_OF_QUESTIONS .
            " interview questions for the following job description : [ {$data['description']} ]. You must act like the interviewer for that job description " .
            "The questions must be technical and I want you to send me only the questions not other words.";
    }

    public function generateFeedbackPrompt(array $questions, array $answers): string
    {
        $prompt = "I am submitting technical interview questions and their given answers. For each, please provide feedback and the correct answer and how should be the response, and assign a score from 1 to 10 (10 being a very good answer). Ensure the feedback is concise and consistent.\n\n";

        foreach ($questions as $index => $question) {
            $number = $index + 1;
            $prompt .= "# Question {$number}: \n{$question['content']}\n# Answer {$number}: \n{$answers[$index]}\n\n";
        }

        $prompt .= "Please do not add new lines in the response. Very important : Provide feedback for each answer in the following JSON format (take this as example): \n{\n  \"feedbacks\": {\n    \"1\": \"feedback and correct answer for question 1.\", \n    \"2\": \"feedback and correct answer for question 2 .\"\n  },\n  \"scores\": {\n    \"1\": score for first answer, \n    \"2\": score for second answer\n  }\n, and so on for every question}";

        return $prompt;
    }
}
