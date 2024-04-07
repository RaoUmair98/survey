<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use App\Models\SurveyResponse;
use App\Models\User;
use App\Models\UserSurvay;
use Illuminate\Http\Request;

class suveyController extends Controller
{
    public function index(Request $request)
    {

        $survey = Survey::findOrfail($request->surveyId);
        return view('userSurvey.stepzero', compact(['survey']));
    }

    public function stepOne(Request $request)
    {

        //Mark Survey Started at User Model
        $user = User::find($request->userId)->update(['isSurveyStarted' => true]);
        //update Survey progress in usersurvey model
        User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()->update(['percentCompleted' => 0]);



        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part II";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        return view('userSurvey.stepone', compact(['survey', 'part', 'questions']));
    }

    public function stepTwo(Request $request)
    {

        //update Survey progress in usersurvey model
        if ($request->has('answer') && count($request->answer) > 0) {
            foreach ($request->answer as $key => $answer) {

                SurveyResponse::updateOrCreate(
                    ['question_id' => $key, 'survey_id' => $request->surveyId, 'user_id' => $request->userId],
                    ['response' => $answer]
                );
            }
        }

        //calculate the survey percentage
        $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
        $totalResponse = SurveyResponse::where('user_id', $request->userId)->where('survey_id', $request->surveyId)->get()->count();
        //dd($totalResponse, $totalQuestions);
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;

        User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()->update(['percentCompleted' => $percentCompleted]);


        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part III";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        return view('userSurvey.steptwo', compact(['survey', 'part', 'questions']));
    }

    public function stepThree(Request $request)
    {
        //save part III
        //update Survey progress in usersurvey model
        if ($request->has('answer') && count($request->answer) > 0) {
            foreach ($request->answer as $key => $answer) {

                SurveyResponse::updateOrCreate(
                    ['question_id' => $key, 'survey_id' => $request->surveyId, 'user_id' => $request->userId],
                    ['response' => $answer]
                );
            }
        }

        //calculate the survey percentage
        $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
        $totalResponse = SurveyResponse::where('user_id', $request->userId)->where('survey_id', $request->surveyId)->get()->count();
        //dd($totalResponse, $totalQuestions);
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;

        User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()->update(['percentCompleted' => $percentCompleted]);

        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part IV";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        return view('userSurvey.stepthree', compact(['survey', 'part', 'questions']));
    }

    public function stepFour(Request $request)
    {
        
        //update Survey progress in usersurvey model
        if ($request->has('answer') && count($request->answer) > 0) {
            foreach ($request->answer as $key => $answer) {

                SurveyResponse::updateOrCreate(
                    ['question_id' => $key, 'survey_id' => $request->surveyId, 'user_id' => $request->userId],
                    ['response' => $answer]
                );
            }
        }

        //calculate the survey percentage
        $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
        $totalResponse = SurveyResponse::where('user_id', $request->userId)->where('survey_id', $request->surveyId)->get()->count();
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;

        User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()->update(['percentCompleted' => $percentCompleted]);
        //end
        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part V";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        return view('userSurvey.stepfive', compact(['survey', 'part', 'questions']));
    }

    public function stepFive(Request $request)
    {
        //update Survey progress in usersurvey model
        if ($request->has('answer') && count($request->answer) > 0) {
            foreach ($request->answer as $key => $answer) {

                SurveyResponse::updateOrCreate(
                    ['question_id' => $key, 'survey_id' => $request->surveyId, 'user_id' => $request->userId],
                    ['response' => $answer]
                );
            }
        }

        //calculate the survey percentage
        $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
        $totalResponse = SurveyResponse::where('user_id', $request->userId)->where('survey_id', $request->surveyId)->get()->count();
        //dd($totalResponse, $totalQuestions);
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;

        User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()->update(['percentCompleted' => $percentCompleted]);
        //end

        //save part V

        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part VI";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        return view('userSurvey.stepsix', compact(['survey', 'part', 'questions']));
    }

    public function stepSix(Request $request)
    {
        //update Survey progress in usersurvey model
        if ($request->has('answer') && count($request->answer) > 0) {
            foreach ($request->answer as $key => $answer) {

                SurveyResponse::updateOrCreate(
                    ['question_id' => $key, 'survey_id' => $request->surveyId, 'user_id' => $request->userId],
                    ['response' => $answer]
                );
            }
        }

        //calculate the survey percentage
        $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
        $totalResponse = SurveyResponse::where('user_id', $request->userId)->where('survey_id', $request->surveyId)->get()->count();
        //dd($totalResponse, $totalQuestions);
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;

        User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()
            ->update([
                'percentCompleted' => $percentCompleted,
                'survayCompleted' => true
            ]);
        // Flash success message
        session()->flash('success', 'Survey completed successfully.');

        return redirect()->route('dashboard');
    }
}
