<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DirectorSurveyController;
use App\Http\Controllers\ExecutiveDirectorController;
use App\Http\Controllers\ManagerSurvayController;
use App\Http\Controllers\superadminController;
use App\Http\Controllers\suveyController;
use App\Http\Controllers\UserSurveyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::view('/',  function () {
//     return redirect('/login');
// });

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/survey', [suveyController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('survey');

Route::post('/survey/stepOne', [suveyController::class, 'stepOne'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('surveyOne');

Route::post('/survey/stepTwo', [suveyController::class, 'stepTwo'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('surveyTwo');

Route::post('/survey/stepThree', [suveyController::class, 'stepThree'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('surveyThree');

Route::post('/survey/stepFour', [suveyController::class, 'stepFour'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('surveyFour');

Route::post('/survey/stepFive', [suveyController::class, 'stepFive'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('surveyFive');

Route::post('/survey/stepSix', [suveyController::class, 'stepSix'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('surveySix');

// manager
Route::get('/survey/manager', [ManagerSurvayController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('manager.survey');

Route::post('/survey/manager/stepOne', [ManagerSurvayController::class, 'stepOne'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('manager.surveyOne');

Route::post('/survey/manager/stepTwo', [ManagerSurvayController::class, 'stepTwo'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('manager.surveyTwo');

Route::post('/survey/manager/stepThree', [ManagerSurvayController::class, 'stepThree'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('manager.surveyThree');

Route::post('/survey/manager/stepFour', [ManagerSurvayController::class, 'stepFour'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('manager.surveyFour');

Route::post('/survey/manager/stepFive', [ManagerSurvayController::class, 'stepFive'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('manager.surveyFive');

Route::post('/survey/manager/stepSix', [ManagerSurvayController::class, 'stepSix'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('manager.surveySix');


//director

Route::get('/survey/{manager}/{manager_id}/employee_progress', [DirectorSurveyController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:director'])
    ->name('director.employee_progress');

Route::post('/survey/view_completed', [UserSurveyController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('survey.view_completed');


    


Route::get('/dashboard', [superadminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/allusers', [superadminController::class, 'allUsers'])->middleware(['auth', 'verified'])->name('UserManagement');
Route::get('/dashboard/adduser', [superadminController::class, 'addUser'])->middleware(['auth', 'verified'])->name('addUser');
Route::get('/dashboard/edituser', [superadminController::class, 'editUser'])->middleware(['auth', 'verified'])->name('editUser');


Route::get('/dashboard/allSurvey', [superadminController::class, 'allSurvay'])->middleware(['auth', 'verified'])->name('allSurvey');
Route::get('/dashboard/responseSurvey', [superadminController::class, 'responseSurvay'])->middleware(['auth', 'verified'])->name('responseSurvey');
Route::get('/dashboard/completedSurveys', [superadminController::class, 'completedSurvays'])->middleware(['auth', 'verified'])->name('completedSurvays');
Route::get('/dashboard/progressSurveys', [superadminController::class, 'progressSurvays'])->middleware(['auth', 'verified'])->name('progressSurvays');
Route::get('/dashboard/notstartedSurveys', [superadminController::class, 'notstartedSurvays'])->middleware(['auth', 'verified'])->name('notstartedSurvays');


Route::get('/dashboard/createSurvey', [superadminController::class, 'createSurvay'])->middleware(['auth', 'verified'])->name('createSurvey');
Route::post('/dashboard/createNewSurvey', [superadminController::class, 'createNewSurvay'])->middleware(['auth', 'verified'])->name('createNewSurvey');



Route::get('/dashboard/editSurvey', [superadminController::class, 'editSurvay'])->middleware(['auth', 'verified'])->name('editSurvey');
Route::patch('/dashboard/updateSurvey', [superadminController::class, 'updateSurvay'])->middleware(['auth', 'verified'])->name('updateSurvey');
Route::patch('/dashboard/updateQuestion', [superadminController::class, 'updateQuestion'])->middleware(['auth', 'verified'])->name('updateQuestion');
Route::post('/dashboard/storeQuestion', [superadminController::class, 'storeQuestion'])->middleware(['auth', 'verified'])->name('storeQuestion');
Route::delete('/questions/{id}', [superadminController::class, 'deleteQuestion'])->name('questions.delete');

Route::get('/dashboard/viewSurvey', [superadminController::class, 'viewSurvay'])->middleware(['auth', 'verified'])->name('viewSurvey');



Route::get('/dashboard/viewSurveyStepOne', [superadminController::class, 'viewSurvayStepOne'])->middleware(['auth', 'verified'])->name('viewSurveyStepOne');
Route::get('/dashboard/viewSurveyStepTwo', [superadminController::class, 'viewSurvaySteptwo'])->middleware(['auth', 'verified'])->name('viewSurveySteptwo');
Route::get('/dashboard/viewSurveyStepThree', [superadminController::class, 'viewSurvayStepthree'])->middleware(['auth', 'verified'])->name('viewSurveyStepthree');
Route::get('/dashboard/viewSurveyStepFour', [superadminController::class, 'viewSurvayStepfour'])->middleware(['auth', 'verified'])->name('viewSurveyStepfour');
Route::get('/dashboard/viewSurveyStepFive', [superadminController::class, 'viewSurvayStepfive'])->middleware(['auth', 'verified'])->name('viewSurveyStepfive');
Route::get('/dashboard/viewSurveyStepSix', [superadminController::class, 'viewSurvayStepsix'])->middleware(['auth', 'verified'])->name('viewSurveyStepsix');

Route::get('/sendSurveyInvite', [superadminController::class, 'sendSurvayInvite'])->middleware(['auth', 'verified'])->name('sendSurveyInvite');
Route::post('/assignSurvey', [superadminController::class, 'assignSurvey'])->middleware(['auth', 'verified'])->name('assignSurvey');
Route::delete('/surveys/{surveyId}', [superadminController::class, 'delete'])
    ->name('deleteSurvey');
Route::post('send-reminder', [superadminController::class, 'sendReminder'])->middleware(['auth', 'verified'])->name('sendReminder');


// Executive Director

Route::get('/dashboard', [ExecutiveDirectorController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/allusers', [ExecutiveDirectorController::class, 'allUsers'])->middleware(['auth', 'verified'])->name('UserManagement');
Route::get('/dashboard/adduser', [ExecutiveDirectorController::class, 'addUser'])->middleware(['auth', 'verified'])->name('addUser');
Route::get('/dashboard/edituser', [ExecutiveDirectorController::class, 'editUser'])->middleware(['auth', 'verified'])->name('editUser');


Route::get('/dashboard/allSurvey', [ExecutiveDirectorController::class, 'allSurvay'])->middleware(['auth', 'verified'])->name('allSurvey');
Route::get('/dashboard/responseSurvey', [ExecutiveDirectorController::class, 'responseSurvay'])->middleware(['auth', 'verified'])->name('responseSurvey');
Route::get('/dashboard/completedSurveys', [ExecutiveDirectorController::class, 'completedSurvays'])->middleware(['auth', 'verified'])->name('completedSurvays');
Route::get('/dashboard/progressSurveys', [ExecutiveDirectorController::class, 'progressSurvays'])->middleware(['auth', 'verified'])->name('progressSurvays');
Route::get('/dashboard/notstartedSurveys', [ExecutiveDirectorController::class, 'notstartedSurvays'])->middleware(['auth', 'verified'])->name('notstartedSurvays');


Route::get('/dashboard/createSurvey', [ExecutiveDirectorController::class, 'createSurvay'])->middleware(['auth', 'verified'])->name('createSurvey');
Route::post('/dashboard/createNewSurvey', [ExecutiveDirectorController::class, 'createNewSurvay'])->middleware(['auth', 'verified'])->name('createNewSurvey');



Route::get('/dashboard/editSurvey', [ExecutiveDirectorController::class, 'editSurvay'])->middleware(['auth', 'verified'])->name('editSurvey');
Route::patch('/dashboard/updateSurvey', [ExecutiveDirectorController::class, 'updateSurvay'])->middleware(['auth', 'verified'])->name('updateSurvey');
Route::patch('/dashboard/updateQuestion', [ExecutiveDirectorController::class, 'updateQuestion'])->middleware(['auth', 'verified'])->name('updateQuestion');
Route::post('/dashboard/storeQuestion', [ExecutiveDirectorController::class, 'storeQuestion'])->middleware(['auth', 'verified'])->name('storeQuestion');
Route::delete('/questions/{id}', [ExecutiveDirectorController::class, 'deleteQuestion'])->name('questions.delete');

Route::get('/dashboard/viewSurvey', [ExecutiveDirectorController::class, 'viewSurvay'])->middleware(['auth', 'verified'])->name('viewSurvey');



Route::get('/dashboard/viewSurveyStepOne', [ExecutiveDirectorController::class, 'viewSurvayStepOne'])->middleware(['auth', 'verified'])->name('viewSurveyStepOne');
Route::get('/dashboard/viewSurveyStepTwo', [ExecutiveDirectorController::class, 'viewSurvaySteptwo'])->middleware(['auth', 'verified'])->name('viewSurveySteptwo');
Route::get('/dashboard/viewSurveyStepThree', [ExecutiveDirectorController::class, 'viewSurvayStepthree'])->middleware(['auth', 'verified'])->name('viewSurveyStepthree');
Route::get('/dashboard/viewSurveyStepFour', [ExecutiveDirectorController::class, 'viewSurvayStepfour'])->middleware(['auth', 'verified'])->name('viewSurveyStepfour');
Route::get('/dashboard/viewSurveyStepFive', [ExecutiveDirectorController::class, 'viewSurvayStepfive'])->middleware(['auth', 'verified'])->name('viewSurveyStepfive');
Route::get('/dashboard/viewSurveyStepSix', [ExecutiveDirectorController::class, 'viewSurvayStepsix'])->middleware(['auth', 'verified'])->name('viewSurveyStepsix');

Route::get('/sendSurveyInvite', [ExecutiveDirectorController::class, 'sendSurvayInvite'])->middleware(['auth', 'verified'])->name('sendSurveyInvite');
Route::post('/assignSurvey', [ExecutiveDirectorController::class, 'assignSurvey'])->middleware(['auth', 'verified'])->name('assignSurvey');
Route::delete('/surveys/{surveyId}', [ExecutiveDirectorController::class, 'delete'])
    ->name('deleteSurvey');
Route::post('send-reminder', [ExecutiveDirectorController::class, 'sendReminder'])->middleware(['auth', 'verified'])->name('sendReminder');



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
