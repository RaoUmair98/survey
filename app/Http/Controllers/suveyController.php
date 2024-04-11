<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Question;
use App\Models\Survey;
use App\Models\SurveyCategory;
use App\Models\SurveyResponse;
use App\Models\User;
use App\Models\UserSurvay;
use Illuminate\Http\Request;

class suveyController extends Controller
{
    public function index(Request $request)
    {
        $survey = Survey::findOrfail($request->surveyId);
        $category = SurveyCategory::where('id', $survey->category_id)->get();
        $category_name = $category->pluck('name')->toArray();
        $evaluation = Evaluation::where('survey_id', $survey->id)->get();
        $user_survey = UserSurvay::where('survey_id', $survey->id)->get();

        foreach ($user_survey as $surveys){
            $percentage = $surveys->percentCompleted == 100;
        }
        return view('userSurvey.stepzero', compact(['survey', 'percentage', 'category_name', 'evaluation']));
    }

        public function stepOne(Request $request)
        {
            
            //Mark Survey Started at User Model
            $user = User::find($request->userId)->update(['isSurveyStarted' => true]);

            $get_surveys = SurveyResponse::where('user_id', $request->userId)->get();

            //update Survey progress in usersurvey model
            $update_survey = User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first();
            if(!$update_survey === null){
                User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()->update(['percentCompleted' => 0]);
            
            }
            else{

                $user_survey = UserSurvay::where('survey_id', $request->surveyId)->get();
                $survey_id = $user_survey->pluck('survey_id')->toArray();
                $survey = Survey::where('id', $survey_id)->get();
                $survey_title = $survey->pluck('title')->toArray();
                $survey_end_date = $survey->pluck('end_date')->toArray();
                $survey_status = $survey->pluck('status')->toArray();
                $category_id = $survey->pluck('category_id')->toArray();
                $category = SurveyCategory::where('id', $category_id)->get();
                $category_name = $category->pluck('name')->toArray();
                $part = "Part II";
                $questions = Question::where('survey_id', $survey_id)->where('part', $part)->get();

            }

            return view('userSurvey.stepone', compact(['get_surveys','survey', 'part', 'questions', 'survey_title', 'survey_end_date', 'survey_status', 'category_name', 'survey_id']));
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

        $get_surveys = SurveyResponse::where('user_id', $request->userId)->get();


        //calculate the survey percentage
        $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
        $totalResponse = SurveyResponse::where('user_id', $request->userId)->where('survey_id', $request->surveyId)->get()->count();
        //dd($totalResponse, $totalQuestions);
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;

        User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()->update(['percentCompleted' => $percentCompleted]);


        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part III";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        return view('userSurvey.steptwo', compact(['survey', 'part', 'questions', 'get_surveys']));
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

        $get_surveys = SurveyResponse::where('user_id', $request->userId)->get();

        //calculate the survey percentage
        $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
        $totalResponse = SurveyResponse::where('user_id', $request->userId)->where('survey_id', $request->surveyId)->get()->count();
        //dd($totalResponse, $totalQuestions);
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;

        User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()->update(['percentCompleted' => $percentCompleted]);

        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part IV";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        return view('userSurvey.stepthree', compact(['survey', 'part', 'questions', 'get_surveys']));
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

        $get_surveys = SurveyResponse::where('user_id', $request->userId)->get();

        //calculate the survey percentage
        $totalQuestions = Question::where('survey_id', $request->surveyId)->get()->count();
        $totalResponse = SurveyResponse::where('user_id', $request->userId)->where('survey_id', $request->surveyId)->get()->count();
        $percentCompleted = ($totalResponse / $totalQuestions) * 100;

        User::find($request->userId)->userSurveys->where('survey_id', $request->surveyId)->first()->update(['percentCompleted' => $percentCompleted]);
        //end
        $survey = Survey::findOrfail($request->surveyId);
        $part = "Part V";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        return view('userSurvey.stepfive', compact(['survey', 'part', 'questions', 'get_surveys']));
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

        $get_surveys = SurveyResponse::where('user_id', $request->userId)->get();

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
        return view('userSurvey.stepsix', compact(['survey', 'part', 'questions', 'get_surveys']));
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
