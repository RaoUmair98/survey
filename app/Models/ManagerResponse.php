<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'response',
        'survey_id',
        'user_id',
        'subordinate_id'
    ];
}
