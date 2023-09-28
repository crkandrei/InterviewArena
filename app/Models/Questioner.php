<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questioner extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the questionare.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the questions for the questionare.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
