<?php

namespace App\Http\Controllers;

use App\Models\Questioner;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;


class QuestionerController extends Controller
{
    public function questionersList(Request $request): Response
    {
        return Inertia::render('Profile/QuestionersList', [
            'questioners' => $request->user()->questioners()->paginate(10)->withQueryString(),
        ]);
    }

    public function showQuestioner(Request $request, $id)
    {
        $questioner = Questioner::with('questions.answer.feedback')->find($id);

        $questions = $questioner->questions->pluck('content');
        $answers = $questioner->questions->pluck('answer.answer_content');
        $feedbacks = $questioner->questions->pluck('answer.feedback.content');
        $scores = $questioner->questions->pluck('answer.feedback.score');

        return Inertia::render('Questioner-Show', [
            'questions' => $questions,
            'answers' => $answers,
            'feedbacks' => $feedbacks,
            'scores' => $scores
        ]);
    }
}
