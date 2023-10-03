<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'questioner_id',
        'content',
        'category',
    ];

    public function answer() {
        return $this->hasOne(UserAnswer::class);
    }

    /**
     * Get the questioner that owns the question.
     */
    public function questioner()
    {
        return $this->belongsTo(Questioner::class);
    }

}
