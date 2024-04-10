<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use App\Models\SurveyCategory;
use App\Models\SurveyResponse;
use App\Models\User;
use App\Models\UserSurvay;
use Illuminate\Http\Request;

class UserSurveyController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $user_surveys = UserSurvay::where('user_id', $user->id)->get();
        $surveys = Survey::whereIn('id', $user_surveys->pluck('survey_id'))->get();
        $survey_id = $surveys->pluck('id')->toArray(); 
        $category_ids = $surveys->pluck('category_id')->unique();
        $categories = SurveyCategory::whereIn('id', $category_ids)->get();

        // Now, let's prepare the data for the view
        $survey_data = $surveys->map(function ($survey) use ($categories) {
        $category = $categories->where('id', $survey->category_id)->first();
        return [
                'id' => $survey->id,
                'title' => $survey->title,
                'status' => $survey->status,
                'end_date' => $survey->end_date,
                'category_name' => $category ? $category->name : null,
             ];
        });

        // dd($survey_data);
        $questions = Question::where('survey_id', $survey_id)->get();
        $parts = $questions->unique('part')->pluck('part','partTitle')->toArray();
        $userSurveyResponse = SurveyResponse::where('survey_id', $survey_id)->where('user_id', $request->userId)->get();

        return view('viewCompleatedSurveys.stepone', compact('survey_data', 'questions', 'userSurveyResponse', 'parts'));

    }
}
