<?php

namespace App\Http\Controllers;

use App\Mail\SurvayInvitationMail;
use App\Mail\SurveyUserIntimation;
use App\Mail\SurvayReminderMail;
use App\Models\ManagerResponse;
use App\Models\Question;
use App\Models\Role;
use App\Models\Survey;
use App\Models\SurveyCategory;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSurvay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class superadminController extends Controller
{
    public function index()
    {
        $allUsers = User::where('role_id', '!=', 1)->get();
        return view('superAdmin.dashboard', compact(['allUsers']));
    }

    public function allUsers(Request $request)
    {
        $role_id = $request->role_id;
        $roleName = Role::findOrFail($role_id)->role_name;
        return view('superAdmin.userManagement', compact(['role_id', 'roleName']));
    }

    public function addUser()
    {
        return view('dashboard.adduser');
    }

    public function editUser(Request $request)
    {
        $userId = $request->userId;
        return view('dashboard.edituser', compact(['userId']));
    }


    public function allSurvay(Request $request)
    {
        return view('superAdmin.survayManagemnet');
    }

    public function responseSurvay(Request $request)
    {
        $role_id = Auth::user()->role->id;
      
        if ($role_id == 1) {
             $usersurveys = UserSurvay::paginate(10);

             foreach ($usersurveys as $survey) {
                $userId = $survey->user_id;
                $surveyId = $survey->survey_id;
                $name = User::where('id', $userId)->value('name');
                $title = Survey::where('id', $surveyId)->value('title');
            }
       
             //  dd($usersurveys);
         } else {
            /** @var \App\User $user */
            $user =  Auth::user();
            $name = User::where('id', $user->id)->value('name');
            $subordinates = $user->subordinates()->pluck('id')->toArray();
            $usersurveys = UserSurvay::whereIn('user_id', $subordinates)->paginate(10);
            foreach ($usersurveys as $survey) {
                $userId = $survey->user_id;
                $surveyId = $survey->survey_id;
                $name = User::where('id', $userId)->value('name');
                $title = Survey::where('id', $surveyId)->value('title');
            }
        }

        return view('superAdmin.survayResponse', compact(['usersurveys', 'name', 'title']));
    }

    public function editSurvay(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        return view('superAdmin.editSurvey', compact(['survey']));
    }

    public function updateQuestion(Request $request)
    {

        try {
            $question = Question::findOrFail($request->id);
            $question->update($request->all());
            return back()->with('success_message', 'Question updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error_message', 'Failed to update question.');
        }
    }

    public function updateSurvay(Request $request)
    {

        $survey = Survey::findOrFail($request->id);
        $survey->update($request->all());
        return redirect()->route('editSurvay', ['Id' => $request->id]);
    }

    public function storeQuestion(Request $request)
    {

        Question::create($request->all());
        return back()->with('success_message', 'Question Added successfully.');
    }

    public function deleteQuestion(Request $request, $id)
    {

        $a = Question::destroy($id);
        if ($a) {
            return back()->with('success_message', 'Question deleted successfully.');
        }
        return back()->with('error_message', 'Something went worng.');
    }

    public function viewSurvay(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        return view('superAdmin.viewSurvay', compact(['survey']));
    }

    // public function viewSurvayStepOne(Request $request)
    // {
    //     $survey = Survey::findOrFail($request->Id);
    //     $part = "Part II"
    //     $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
    //     //dd($part,$questions);
    //     return view('survey.stepone', compact(['survey', 'part', 'questions']));
    // }

    public function viewSurvaySteptwo(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        $part = "Part II";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        $questionIds = $questions->pluck('id')->all(); 
        $responses = SurveyResponse::where('survey_id', $survey->id)
                               ->whereIn('question_id', $questionIds)
                               ->get(['question_id', 'response']);
        $managers = ManagerResponse::where('survey_id', $survey->id)
                               ->whereIn('question_id', $questionIds)
                               ->get(['question_id', 'response']);
        return view('survey.steptwo', compact('survey', 'part', 'questions', 'responses', 'managers'));
    }

    public function viewSurvayStepthree(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        $part = "Part III";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        $questionIds = $questions->pluck('id')->all(); 
        
        $responses = SurveyResponse::where('survey_id', $survey->id)
                                ->whereIn('question_id', $questionIds)
                                ->get(['question_id', 'response']);

        $managers = ManagerResponse::where('survey_id', $survey->id)
                                ->whereIn('question_id', $questionIds)
                                ->get(['question_id', 'response']); 

        //dd($part,$questions);
        return view('survey.stepthree', compact(['survey', 'part', 'questions' , 'responses', 'managers']));
    }

    public function viewSurvayStepfour(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        $part = "Part IV";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        $questionIds = $questions->pluck('id')->all(); 
        
        $responses = SurveyResponse::where('survey_id', $survey->id)
                                ->whereIn('question_id', $questionIds)
                                ->get(['question_id', 'response']);

        $managers = ManagerResponse::where('survey_id', $survey->id)
                                ->whereIn('question_id', $questionIds)
                                ->get(['question_id', 'response']); 

        //dd($part,$questions);
        return view('survey.stepfour', compact(['survey', 'part', 'questions' , 'responses', 'managers']));
    }

    public function viewSurvayStepfive(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        $part = "Part V";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        $questionIds = $questions->pluck('id')->all(); 
        
        $responses = SurveyResponse::where('survey_id', $survey->id)
                                ->whereIn('question_id', $questionIds)
                                ->get(['question_id', 'response']);

        $managers = ManagerResponse::where('survey_id', $survey->id)
                                ->whereIn('question_id', $questionIds)
                                ->get(['question_id', 'response']); 

        //dd($part,$questions);
        return view('survey.stepfive', compact(['survey', 'part', 'questions' , 'responses', 'managers']));
    }

    public function viewSurvayStepsix(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        $part = "Part VI";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        $questionIds = $questions->pluck('id')->all(); 
        
        $responses = SurveyResponse::where('survey_id', $survey->id)
                                ->whereIn('question_id', $questionIds)
                                ->get(['question_id', 'response']);

        $managers = ManagerResponse::where('survey_id', $survey->id)
                                ->whereIn('question_id', $questionIds)
                                ->get(['question_id', 'response']); 

        //dd($part,$questions);
        return view('survey.stepsix', compact(['survey', 'part', 'questions' , 'responses', 'managers']));
    }





    public function createSurvay(Request $request)
    {
        $survayCategories = SurveyCategory::all();

        return view(
            'superAdmin.createSurvay',
            compact([
                'survayCategories'
            ])
        );
    }


    public function createNewSurvay(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'category_id' => ['required', 'integer', 'exists:survey_categories,id'], // Ensure category_id exists in the SurveyCategory model
            'title' => 'required|string',
            'description' => 'nullable|string', // Allow description to be nullable

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $a = Survey::create($request->all() + ['status' => "active", "user_id" => Auth::user()->id]);
        $survayCategories = SurveyCategory::all();

        if ($a) {
            return back()->with('success_message', 'Survey Created successfully.');
        }
        return back()->with('error_message', 'Something went worng.');
    }



    public function sendSurvayInvite(Request $request)
    {
        $user = User::findOrFail($request->userId);
        $surveys = Survey::all();
        
        // Check if the user's invite has already been sent
        if ($user->inviteSend) {
            // Send a survey reminder email
            Mail::to($user)->send(new SurvayReminderMail());
            
            // Redirect back to the user management page with a success message
            return redirect()->route('UserManagement', ['role_id' => 1])
                             ->with('success_message', 'Survey Reminder sent to ' . $user->name . ' email (' . $user->email . ')');
        }
    
        // If the user's invite has not been sent yet, return the view to assign a survey
        return view('superAdmin.assignSurvey', compact('user', 'surveys'));
    
        // $response = Password::sendResetLink(["email" => $user->email]);
        // Log::info(['$response' => $response ]);

        // if ($response == Password::RESET_LINK_SENT) {
        //     $user->update(['inviteSend' => true]);
        //     return redirect()->route('UserManagement', ['role_id' => 1])->with('success_message', 'Survay link sent to ' . $user->name . ' email (' . $user->email . ')');
        // } else {
        //     return redirect()->route('UserManagement', ['role_id' => 1])->with('error_message', 'Unable to send  link');
        // }
    }

    public function assignSurvey(Request $request)
    {
        // dd($request->all());
        $user = $request->user();

        $survey = Survey::where('user_id', $user->id)->get();
       
        try {
            // Assigning survey to the user
            UserSurvay::create([
                'user_id' => $request->user_id,
                'survey_id' => $request->survey_id,
                'percentCompleted' => 0
            ]);

            // Finding the user by their ID
            $user = User::find($request->user_id);
            
            // Sending a reminder email to the user
            $survey = Survey::find($request->survey_id);
            //find manager
            $manager = $user->getManager();

            //find role of the manager (if manager , director , superadmin)
            $role_id = $manager->role->id;

            $flashMessages = [];
            $emailStatus = [];

            $emailStatus['Employee'] = Mail::to($user->email)->send(new SurvayInvitationMail($surveyStart = url('survey?surveyId=1'),$survey));

            if ($emailStatus['Employee']) {
                // Updating inviteSend to true for the user
                $user->update(['inviteSend' => true]);
            }

            $flashMessages[] = [
                'role' => 'Employee',
                'name' => $user->name,
                'email' => $user->email,
                'status' => $emailStatus['Employee'] ? 'Sent' : 'Failed'
            ];


            switch ($role_id) {
                case 1:
                    //send email to manager
                    $emailStatus['Super Admin'] = Mail::to($manager->email)->send(new SurveyUserIntimation($surveyLink = url('dashboard/viewSurvay?Id=1'), $survey, $user));
                    $flashMessages[] = [
                        'role' => 'Super Admin',
                        'name' => $manager->name,
                        'email' => $manager->email,
                        'status' => $emailStatus['Super Admin'] ? 'Sent' : 'Failed'
                    ];

                    break;
                case 2:
                    $director = $manager->getManager();
                    $superAdmin = $director->getManager();
                    $emailStatus['director'] = Mail::to($director->email)->send(new SurveyUserIntimation($surveyLink = url('dashboard/viewSurvay?Id=1'), $survey, $user));
                    $emailStatus['super_admin'] = Mail::to($superAdmin->email)->send(new SurveyUserIntimation($surveyLink = url('dashboard/viewSurvay?Id=1'), $survey, $user));
                    $flashMessages[] = [
                        'role' => 'Director',
                        'name' => $director->name,
                        'email' => $director->email,
                        'status' => $emailStatus['director'] ? 'Sent' : 'Failed'
                    ];
                    $flashMessages[] = [
                        'role' => 'Super Admin',
                        'name' => $superAdmin->name,
                        'email' => $superAdmin->email,
                        'status' => $emailStatus['super_admin'] ? 'Sent' : 'Failed'
                    ];
                    break;
                case 3:
                    $director = $manager->getManager();
                    $superAdmin = $director->getManager();
                    $emailStatus['manager'] = Mail::to($manager->email)->send(new SurveyUserIntimation($surveyLink = url('dashboard/viewSurvay?Id=1'), $survey, $user));
                    $emailStatus['director'] = Mail::to($director->email)->send(new SurveyUserIntimation($surveyLink = url('dashboard/viewSurvay?Id=1'), $survey, $user));
                    $emailStatus['super_admin'] = Mail::to($superAdmin->email)->send(new SurveyUserIntimation($surveyLink = url('dashboard/viewSurvay?Id=1'), $survey, $user));
                    $flashMessages[] = [
                        'role' => 'Manager',
                        'name' => $manager->name,
                        'email' => $manager->email,
                        'status' => $emailStatus['manager'] ? 'Sent' : 'Failed'
                    ];
                    $flashMessages[] = [
                        'role' => 'Director',
                        'name' => $director->name,
                        'email' => $director->email,
                        'status' => $emailStatus['director'] ? 'Sent' : 'Failed'
                    ];
                    $flashMessages[] = [
                        'role' => 'Super Admin',
                        'name' => $superAdmin->name,
                        'email' => $superAdmin->email,
                        'status' => $emailStatus['super_admin'] ? 'Sent' : 'Failed'
                    ];
                    break;
                default:
                    $flashMessages[] = "Invalid role ID.";
                    break;
            }

            session()->flash('flash_messages', $flashMessages);

            // Return success response
            return redirect()->route('UserManagement', ['role_id' => 1]);
        } catch (\Exception $e) {
            session()->flash('error_message', 'Invalid Email Address (' . $e . ')');
        }
    }
}
