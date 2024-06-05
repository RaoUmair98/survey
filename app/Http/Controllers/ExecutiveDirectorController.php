<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Survey;
use App\Models\UserSurvay;
use App\Models\SurveyResponse;
use App\Models\ManagerResponse;
use App\Models\SurveyCategory;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Mail\SurvayReminderMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\SurvayInvitationMail;

class ExecutiveDirectorController extends Controller
{
    public function index(Request $request)
    {

        $allUsers = User::where('role_id', '>', 4)->get();
        $user_id = $allUsers->pluck('id')->toArray();
        $user_surveys = UserSurvay::whereIn('user_id', $user_id)->get();
        $manager_survey = ManagerResponse::whereIn('subordinate_id', $user_id)->get();

        return view('executive_director.dashboard', compact(['allUsers', 'user_surveys', 'manager_survey']));
    }

    public function getCompletedSurvey()
    {
        $usersWith100Percentage = User::where('role_id', '>', 4)
        ->leftJoin('user_survays', 'users.id', '=', 'user_survays.user_id')
        ->leftJoin('manager_survays', 'users.id', '=', 'manager_survays.user_id')
        ->where(function ($query) {
            $query->where('user_survays.percentCompleted', '=', 100)
                ->orWhere('manager_survays.percentCompleted', '=', 100);
        })
        ->select('users.*')
        ->distinct()
        ->get();

    }

    public function allUsers(Request $request)
    {
        $role_id = 2;
        $roleName = Role::findOrFail($role_id)->role_name;
        return view('executive_director.userManagement', compact(['role_id', 'roleName']));
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
        return view('executive_director.survayManagemnet');
    }

    public function responseSurvay(Request $request)
    {
        $role_id = Auth::user()->role->id;

        if ($role_id == 2) {
             $usersurveys = UserSurvay::paginate(10);

             $names = [];
             $titles = [];
    
             foreach ($usersurveys as $survey) {
                $userId = $survey->user_id;
                $surveyId = $survey->survey_id;
                // Append names and titles to the arrays
                $names[$surveyId] = User::where('id', $userId)->value('name');
                $titles[$surveyId] = Survey::where('id', $surveyId)->value('title');
            }

         } else {
            /** @var \App\User $user */
            $user =  Auth::user();
            $name = User::where('id', $user->id)->value('name');
            $subordinates = $user->subordinates()->pluck('id')->toArray();
            $usersurveys = UserSurvay::whereIn('user_id', $subordinates)->paginate(10);

            
            // Initialize arrays to store names and titles
            $names = [];
            $titles = [];

            foreach ($usersurveys as $survey) {
                $userId = $survey->user_id;
                $surveyId = $survey->survey_id;
                // Append names and titles to the arrays
                $names[$surveyId] = User::where('id', $userId)->value('name');
                $titles[$surveyId] = Survey::where('id', $surveyId)->value('title');
            }
        }

        return view('executive_director.survayResponse', compact(['usersurveys', 'names', 'titles']));
    }

    public function completedSurvays(Request $request)
    {
        $role_id = Auth::user()->role->id;

        if ($role_id == 2) {
            $usersurveys = UserSurvay::where('percentCompleted', 100)->paginate(10);
            $percentage = $usersurveys->pluck('percentCompleted')->toArray();

             $names = [];
             $titles = [];
    
             foreach ($usersurveys as $survey) {
                $userId = $survey->user_id;
                $surveyId = $survey->survey_id;
                // Append names and titles to the arrays
                $names[$surveyId] = User::where('id', $userId)->value('name');
                $titles[$surveyId] = Survey::where('id', $surveyId)->value('title');
            }

         } else {
            /** @var \App\User $user */
            $user =  Auth::user();
            $name = User::where('id', $user->id)->value('name');
            $subordinates = $user->subordinates()->pluck('id')->toArray();
            $usersurveys = UserSurvay::whereIn('user_id', $subordinates)->where('percentCompleted', 100)->paginate(10);
            $percentage = $usersurveys->pluck('percentCompleted')->toArray();
            
            // Initialize arrays to store names and titles
            $names = [];
            $titles = [];

            foreach ($usersurveys as $survey) {
                $userId = $survey->user_id;
                $surveyId = $survey->survey_id;
                // Append names and titles to the arrays
                $names[$surveyId] = User::where('id', $userId)->value('name');
                $titles[$surveyId] = Survey::where('id', $surveyId)->value('title');
            }
        }


        return view('executive_director.completedSurvays', compact(['usersurveys', 'names', 'titles', 'percentage']));
    }
    
    public function progressSurvays(Request $request)
    {
        $role_id = Auth::user()->role->id;

        if ($role_id == 2) {
            $usersurveys = UserSurvay::where('percentCompleted', '<', 100)
            ->where('percentCompleted', '>', 0)
            ->paginate(10);
            $percentage = $usersurveys->pluck('percentCompleted')->toArray();

             $names = [];
             $titles = [];
    
             foreach ($usersurveys as $survey) {
                $userId = $survey->user_id;
                $surveyId = $survey->survey_id;
                // Append names and titles to the arrays
                $names[$surveyId] = User::where('id', $userId)->value('name');
                $titles[$surveyId] = Survey::where('id', $surveyId)->value('title');
            }

         } else {
            /** @var \App\User $user */
            $user =  Auth::user();
            $name = User::where('id', $user->id)->value('name');
            $subordinates = $user->subordinates()->pluck('id')->toArray();
            $usersurveys = UserSurvay::whereIn('user_id', $subordinates)
            ->where('percentCompleted', '<', 100)
            ->where('percentCompleted', '>', 0)
            ->paginate(10);
            $percentage = $usersurveys->pluck('percentCompleted')->toArray();
            
            // Initialize arrays to store names and titles
            $names = [];
            $titles = [];

            foreach ($usersurveys as $survey) {
                $userId = $survey->user_id;
                $surveyId = $survey->survey_id;
                // Append names and titles to the arrays
                $names[$surveyId] = User::where('id', $userId)->value('name');
                $titles[$surveyId] = Survey::where('id', $surveyId)->value('title');
            }
        }

        return view('executive_director.progressSurvays', compact(['usersurveys', 'names', 'titles', 'percentage']));
    }

    public function notstartedSurvays(Request $request)
    {
        $role_id = Auth::user()->role->id;

        if ($role_id == 2) {
            $usersurveys = UserSurvay::where('percentCompleted', 0)->paginate(10);
             $percentage = $usersurveys->pluck('percentCompleted')->toArray();

             $names = [];
             $titles = [];
    
             foreach ($usersurveys as $survey) {
                $userId = $survey->user_id;
                $surveyId = $survey->survey_id;
                // Append names and titles to the arrays
                $names[$surveyId] = User::where('id', $userId)->value('name');
                $titles[$surveyId] = Survey::where('id', $surveyId)->value('title');
            }

         } else {
            /** @var \App\User $user */
            $user =  Auth::user();
            $name = User::where('id', $user->id)->value('name');
            $subordinates = $user->subordinates()->pluck('id')->toArray();
            $usersurveys = UserSurvay::whereIn('user_id', $subordinates)->where('percentCompleted', 0)->paginate(10);
            $percentage = $usersurveys->pluck('percentCompleted')->toArray();
            
            // Initialize arrays to store names and titles
            $names = [];
            $titles = [];

            foreach ($usersurveys as $survey) {
                $userId = $survey->user_id;
                $surveyId = $survey->survey_id;
                // Append names and titles to the arrays
                $names[$surveyId] = User::where('id', $userId)->value('name');
                $titles[$surveyId] = Survey::where('id', $surveyId)->value('title');
            }
        }

        return view('executive_director.notstartedSurvays', compact(['usersurveys', 'names', 'titles', 'percentage']));
    }

    public function editSurvay(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        return view('executive_director.editSurvey', compact(['survey']));
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
        return redirect()->route('editSurvey', ['Id' => $request->id]);
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
        return view('executive_director.viewSurvay', compact(['survey']));
    }

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
            'executive_director.createSurvay',
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
        $user = User::where('id', $request->userId)->first();
        // Retrieve the IDs of surveys already assigned to the user
        $assigned_survey_ids = $user->userSurveys->pluck('survey_id')->toArray();

        $surveys = Survey::whereIn('id', $assigned_survey_ids)->get();

        $percentCompleted = [];

        // Check if there are user surveys and retrieve the completion percentage
        if (!empty($user->userSurveys)) {
            $percent = UserSurvay::where('user_id', $user->id)->get();
            $percentCompleted = $percent->pluck('percentCompleted')->toArray();
        }
    
        // Check if the user's invite has already been sent
        // if (!empty($percentCompleted)  && $percentCompleted[0] < 100) {
        //     // Send a survey reminder email
        //     Mail::to($user->email)->send(new SurvayReminderMail());

        //     // Redirect back to the user management page with a success message
        //     return redirect()->route('UserManagement', ['role_id' => 1])
        //                      ->with('success_message', 'Survey Reminder sent to ' . $user->name . ' email (' . $user->email . ')');
        // }
    
        // If no surveys are assigned, retrieve all surveys
        if (empty($assigned_survey_ids)) {
            $other_surveys = Survey::all();
           
        } else {
            // Retrieve surveys that are not assigned to the user
            $other_surveys = Survey::whereNotIn('id', $assigned_survey_ids)->get();
            
        }

        return view('executive_director.assignSurvey', compact('user', 'surveys', 'other_surveys', 'percentCompleted'));
    
        // Check if the user's invite has already been sent
        // if ($user->inviteSend) {
        //     // Send a survey reminder email
        //     Mail::to($user)->send(new SurvayReminderMail());
            
        //     // Redirect back to the user management page with a success message
        //     return redirect()->route('UserManagement', ['role_id' => 1])
        //                      ->with('success_message', 'Survey Reminder sent to ' . $user->name . ' email (' . $user->email . ')');
        // }
    
        // If the user's invite has not been sent yet, return the view to assign a survey
       
        // $response = Password::sendResetLink(["email" => $user->email]);
        // Log::info(['$response' => $response ]);

        // if ($response == Password::RESET_LINK_SENT) {
        //     $user->update(['inviteSend' => true]);
        //     return redirect()->route('UserManagement', ['role_id' => 1])->with('success_message', 'Survay link sent to ' . $user->name . ' email (' . $user->email . ')');
        // } else {
        //     return redirect()->route('UserManagement', ['role_id' => 1])->with('error_message', 'Unable to send  link');
        // }
    }

    public function sendReminder(Request $request)
    {
        // Retrieve the user and survey based on the request
        $user = User::findOrFail($request->user_id);
        $survey = Survey::findOrFail($request->survey_id);
        // Send the reminder email
        Mail::to($user->email)->send(new SurvayReminderMail($survey));

        // Redirect back with a success message
        return redirect()->route('UserManagement', ['role_id' => 2])
                                ->with('success_message', 'Survey Reminder sent to ' . $user->name . ' email (' . $user->email . ')');
   }

    public function delete($surveyId)
    {
        // Find the survey by ID
        $survey = UserSurvay::where('user_id', $surveyId)->first();
        // Delete the survey
        if ($survey) {
            // Delete the survey
            $survey->delete();
    
            // Redirect to the dashboard with a success message
            return redirect()->route('sendSurveyInvite', ['userId' => $surveyId])->with('success_message', 'Survey deleted successfully.');
        } else {
            // Redirect to the dashboard with an error message
            return redirect()->route('sendSurveyInvite', ['userId' => $surveyId])->with('error_message', 'Survey not found.');
        }
    }


    public function assignSurvey(Request $request)
    {
        $user = $request->user();       
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

            $emailStatus['Employee'] = Mail::to($user->email)->send(new SurvayInvitationMail($surveyStart = url('/dashboard'),$survey));

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


            session()->flash('flash_messages', $flashMessages);

            // Return success response
            return redirect()->route('UserManagement', ['role_id' => 2]);
        } catch (\Exception $e) {
            session()->flash('error_message', 'Invalid Email Address (' . $e . ')');
        }
    }




}
