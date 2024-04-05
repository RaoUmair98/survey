<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use App\Models\SurveyResponse;
use App\Models\User;
use App\Models\UserSurvay;
use Illuminate\Http\Request;

class UserSurveyController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->userId);
        $survey = Survey::find($request->surveyId);
        $questions = Question::where('survey_id', $request->surveyId)->get();
        $parts = $questions->unique('part')->pluck('part','partTitle')->toArray();
        $userSurveyResponse = SurveyResponse::where('survey_id', $request->surveyId)->where('user_id', $request->userId)->get();
        // dd($userSurveyResponse);
        return view('viewCompleatedSurveys.stepone', compact(['survey', 'questions', 'userSurveyResponse','parts']));
    }
}
