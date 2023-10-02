<?php

namespace App\Repositories;

use App\Models\Question;
use App\Models\Questioner;

class QuestionRepository
{
    public function createQuestioner($userId, $prompt)
    {
        $questioner = new Questioner();
        $questioner->user_id = $userId;
        $questioner->prompt = $prompt;
        $questioner->save();

        return $questioner;
    }

    public function createQuestion($questionerId, $category, $content)
    {
        return Question::create([
            'questioner_id' => $questionerId,
            'category' => $category,
            'content' => $content,
        ])->toArray();
    }
}
