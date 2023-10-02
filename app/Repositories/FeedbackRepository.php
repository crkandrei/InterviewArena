<?php

namespace App\Repositories;


use App\Models\Feedback;
use App\Models\UserAnswer;


class FeedbackRepository
{
    public function createFeedbackAndUserAnswer($question, $answer, $feedbackArray, $index)
    {
        $createdFeedback = Feedback::create([
            'content' => $feedbackArray['feedbacks'][$index + 1],
            'score' => $feedbackArray['scores'][$index + 1],
        ]);

        UserAnswer::create([
            'question_id' => $question['id'],
            'user_id' => auth()->id(),
            'answer_content' => $answer,
            'feedback_id' => $createdFeedback->id
        ]);

        return $createdFeedback;
    }

}
