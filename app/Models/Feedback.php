<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Feedback extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'content',
        'score'
    ];

    public function answer() {
        return $this->hasOne(UserAnswer::class);
    }
}
