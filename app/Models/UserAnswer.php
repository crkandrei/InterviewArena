<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserAnswer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'question_id',
        'answer_content',
        'feedback_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function feedback() {
        return $this->belongsTo(Feedback::class);
    }

}
