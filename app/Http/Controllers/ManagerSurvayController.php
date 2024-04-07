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
        return view('managerSurvey.stepone', compact(['user_id', 'survey', 'part', 'questions', 'surveyResponses', 'surveyUser', 'managers']));
    }

    public function stepTwo(Request $request)
    {

        $surveyResponses = SurveyResponse::where('survey_id', $request->surveyId)->where('user_id', $request->subordinateId)->get();

        //update Survey progress in usersurvey model
 
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
        $totalResponse =  ManagerResponse::where('user_id', $request->userId)->where('survey_id', $request->surveyId)->where('subordinate_id', $request->subordinateId)->get()->count();
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;


        ManagerSurvay::where('survey_id', $request->surveyId)
            ->where('manager_id', $request->userId)
            ->where('user_id', $request->subordinateId)
            ->first()->update(['percentCompleted' => $percentCompleted]);

        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part III";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        $surveyUser = User::find($request->subordinateId);

        return view('managerSurvey.steptwo', compact(['survey', 'part', 'questions','surveyResponses','surveyUser']));
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
        return view('managersurvey.stepthree', compact(['survey', 'part', 'questions','surveyResponses','surveyUser']));
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
            return view('managersurvey.stepfour', compact(['survey', 'part', 'questions','surveyResponses','surveyUser']));
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
        return view('managersurvey.stepfive', compact(['survey', 'part', 'questions','surveyResponses','surveyUser']));
        }

        public function stepSix(Request $request)
        {
            $surveyResponses = SurveyResponse::where('survey_id', $request->surveyId)->where('user_id', $request->subordinateId)->get();
            dd($surveyResponses);

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
            return view('managersurvey.stepsix', compact(['survey', 'part', 'questions','surveyResponses','surveyUser']));
        }
}
