<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'category_id',
        'end_date',
        'status'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function category()
    {
        return $this->belongsTo(SurveyCategory::class, 'category_id');
    }


    public function evaluation(): HasMany
    {
        return $this->hasMany(Evaluation::class, 'survey_id');
    }
}
