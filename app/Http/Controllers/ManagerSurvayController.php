<?php

namespace App\Http\Controllers;

use App\Models\ManagerResponse;
use App\Models\ManagerSurvay;
use App\Models\Question;
use App\Models\Survey;
use App\Models\SurveyResponse;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerSurvayController extends Controller
{
    public function index(Request $request)
    {

        $survey = Survey::findOrfail($request->surveyId);
        $surveyUser = User::findOrfail($request->userId);
        return view('managerSurvey.stepzero', compact(['survey', 'surveyUser']));
    }

    public function stepOne(Request $request)
    {
        $survey =  $request->surveyId;
        $user_id = $request->userId;
        
        $supervisor = User::find($request->userId);
        $surveyUser = User::find($request->SurveyuserId);
        $surveyResponses = SurveyResponse::where('survey_id', $request->surveyId)->where('user_id', $request->SurveyuserId)->get();
        $managers = ManagerResponse::where('survey_id', $request->surveyId)->where('subordinate_id', $request->SurveyuserId)->get();

        //Mark Survey Started at User Model
        // $user = User::find($request->userId)->update(['isSurveyStarted' => true]);
        // //update Survey progress in usersurvey model
        // User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()->update(['percentCompleted' => 0]);
        ManagerSurvay::create([
            'user_id' => $surveyUser->id,
            'manager_id' =>  $supervisor->id,
            'survey_id' => $request->surveyId,
            'percentCompleted' => 0
        ]);


        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part II";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        $question = $questions->pluck('id')->toArray(); 

        $managerResponses = ManagerResponse::where('survey_id', $request->surveyId)
        ->where('subordinate_id', $request->SurveyuserId)
        ->get()
        ->keyBy('question_id');

        return view('managerSurvey.stepone', compact(['user_id', 'survey', 'part', 'questions', 'surveyResponses', 'surveyUser', 'managers', 'managerResponses']));
    }

    public function stepTwo(Request $request)
{
    // Retrieve survey responses
    $surveyResponses = SurveyResponse::where('survey_id', $request->surveyId)
                                      ->where('user_id', $request->subordinateId)
                                      ->get();

    // Update or create manager responses
    if ($request->has('managerAnswer') && count($request->managerAnswer) > 0) {
        foreach ($request->managerAnswer as $questionId => $response) {
            ManagerResponse::updateOrCreate(
                [
                    'question_id' => $questionId,
                    'survey_id' => $request->surveyId,
                    'user_id' => $request->userId,
                    'subordinate_id' => $request->subordinateId
                ],
                ['response' => $response]
            );
        }
    }

    // Calculate the survey completion percentage
    $totalQuestions = Question::where('survey_id', $request->surveyId)->count();
    $totalResponses = ManagerResponse::where('survey_id', $request->surveyId)
                                     ->where('subordinate_id', $request->subordinateId)
                                     ->count();

    $percentCompleted = ($totalResponses / $totalQuestions) * 100;

    // Update the percentCompleted column in the manager_survays table
    ManagerSurvay::where('survey_id', $request->surveyId)
                 ->where('manager_id', $request->userId)
                 ->where('user_id', $request->subordinateId)
                 ->first()
                 ->update(['percentCompleted' => $percentCompleted]);

    // Prepare for the next part of the survey
    $survey = Survey::findOrFail($request->surveyId);
    $part = "Part III";
    $questions = Question::where('survey_id', $survey->id)
                         ->where('part', $part)
                         ->get();
    $surveyUser = User::find($request->subordinateId);

    return view('managerSurvey.steptwo', compact(['survey', 'part', 'questions', 'surveyResponses', 'surveyUser']));
}


    public function stepThree(Request $request)
    {
        //save part III
        //update Survey progress in usersurvey model
        $surveyResponses = SurveyResponse::where('survey_id', $request->surveyId)->where('user_id', $request->subordinateId)->get();

        if ($request->has('managerAnswer') && count($request->managerAnswer) > 0) {
            foreach ($request->managerAnswer as $key => $answer) {
                ManagerResponse::updateOrCreate(

                    ['question_id' => $key, 'survey_id' => $request->surveyId, 'user_id' => $request->userId, 'subordinate_id' => $request->subordinateId],
                    ['response' => $answer]
                );
            }
        }

        //calculate the survey percentage
        $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
        $totalResponse =  ManagerResponse::where('survey_id', $request->surveyId)->where('subordinate_id', $request->subordinateId)->get()->count();
        
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;
        ManagerSurvay::where('survey_id', $request->surveyId)
            ->where('user_id', $request->subordinateId)
            ->first()->update(['percentCompleted' => $percentCompleted]);
      
        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part IV";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        $surveyUser = User::find($request->subordinateId);
        return view('managerSurvey.stepthree', compact(['survey', 'part', 'questions','surveyResponses','surveyUser']));
    }

        public function stepFour(Request $request)
        {


            $surveyResponses = SurveyResponse::where('survey_id', $request->surveyId)->where('user_id', $request->subordinateId)->get();

            if ($request->has('managerAnswer') && count($request->managerAnswer) > 0) {
                foreach ($request->managerAnswer as $key => $answer) {
                    ManagerResponse::updateOrCreate(
    
                        ['question_id' => $key, 'survey_id' => $request->surveyId, 'user_id' => $request->userId, 'subordinate_id' => $request->subordinateId],
                        ['response' => $answer]
                    );
                }
            }
    
            //calculate the survey percentage
            $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
            $totalResponse =  ManagerResponse::where('survey_id', $request->surveyId)->where('subordinate_id', $request->subordinateId)->get()->count();
            
            $percentCompleted = ($totalResponse / $totalQuestions) * 100;
            ManagerSurvay::where('survey_id', $request->surveyId)
                ->where('user_id', $request->subordinateId)
                ->first()->update(['percentCompleted' => $percentCompleted]);
          
            $survey = Survey::findOrfail($request->surveyId);
            $part = "Part V";
            $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
            $surveyUser = User::find($request->subordinateId);
            return view('managerSurvey.stepfour', compact(['survey', 'part', 'questions','surveyResponses','surveyUser']));
        }

        public function stepFive(Request $request)
        {
            
        $surveyResponses = SurveyResponse::where('survey_id', $request->surveyId)->where('user_id', $request->subordinateId)->get();

        if ($request->has('managerAnswer') && count($request->managerAnswer) > 0) {
            foreach ($request->managerAnswer as $key => $answer) {
                ManagerResponse::updateOrCreate(

                    ['question_id' => $key, 'survey_id' => $request->surveyId, 'user_id' => $request->userId, 'subordinate_id' => $request->subordinateId],
                    ['response' => $answer]
                );
            }
        }

        //calculate the survey percentage
        $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
        $totalResponse =  ManagerResponse::where('survey_id', $request->surveyId)->where('subordinate_id', $request->subordinateId)->get()->count();
        
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;
        ManagerSurvay::where('survey_id', $request->surveyId)
            ->where('user_id', $request->subordinateId)
            ->first()->update(['percentCompleted' => $percentCompleted]);
      
        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part VI";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        $surveyUser = User::find($request->subordinateId);
        session()->flash('success', 'Survey completed successfully.');

    // Redirect to the dashboard
        return view('managerSurvey.stepfive', compact(['survey', 'part', 'questions','surveyResponses','surveyUser']));
        }

        public function stepSix(Request $request)
        {
            $surveyResponses = SurveyResponse::where('survey_id', $request->surveyId)->where('user_id', $request->subordinateId)->get();

            if ($request->has('managerAnswer') && count($request->managerAnswer) > 0) {
                foreach ($request->managerAnswer as $key => $answer) {
                    ManagerResponse::updateOrCreate(
    
                        ['question_id' => $key, 'survey_id' => $request->surveyId, 'user_id' => $request->userId, 'subordinate_id' => $request->subordinateId],
                        ['response' => $answer]
                    );
                }
            }
    
            //calculate the survey percentage
            $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
            $totalResponse =  ManagerResponse::where('survey_id', $request->surveyId)->where('subordinate_id', $request->subordinateId)->get()->count();
            
            $percentCompleted = ($totalResponse / $totalQuestions) * 100;
            ManagerSurvay::where('survey_id', $request->surveyId)
                ->where('user_id', $request->subordinateId)
                ->first()->update(['percentCompleted' => $percentCompleted]);
          
            $survey = Survey::findOrfail($request->surveyId);
            $part = "Part VI";
            $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
            $surveyUser = User::find($request->subordinateId);
            return view('managerSurvey.stepsix', compact(['survey', 'part', 'questions','surveyResponses','surveyUser']));
        }
}
