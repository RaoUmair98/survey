<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DirectorSurveyController;
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

Route::post('/survey/view_compleated', [UserSurveyController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('survey.view_compleated');





Route::get('/dashboard', [superadminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/allusers', [superadminController::class, 'allUsers'])->middleware(['auth', 'verified'])->name('UserManagement');
Route::get('/dashboard/adduser', [superadminController::class, 'addUser'])->middleware(['auth', 'verified'])->name('addUser');
Route::get('/dashboard/edituser', [superadminController::class, 'editUser'])->middleware(['auth', 'verified'])->name('editUser');


Route::get('/dashboard/allSurvay', [superadminController::class, 'allSurvay'])->middleware(['auth', 'verified'])->name('allSurvay');
Route::get('/dashboard/responseSurvay', [superadminController::class, 'responseSurvay'])->middleware(['auth', 'verified'])->name('responseSurvay');

Route::get('/dashboard/createSurvay', [superadminController::class, 'createSurvay'])->middleware(['auth', 'verified'])->name('createSurvay');
Route::post('/dashboard/createNewSurvay', [superadminController::class, 'createNewSurvay'])->middleware(['auth', 'verified'])->name('createNewSurvay');



Route::get('/dashboard/editSurvay', [superadminController::class, 'editSurvay'])->middleware(['auth', 'verified'])->name('editSurvay');
Route::patch('/dashboard/updateSurvay', [superadminController::class, 'updateSurvay'])->middleware(['auth', 'verified'])->name('updateSurvay');
Route::patch('/dashboard/updateQuestion', [superadminController::class, 'updateQuestion'])->middleware(['auth', 'verified'])->name('updateQuestion');
Route::post('/dashboard/storeQuestion', [superadminController::class, 'storeQuestion'])->middleware(['auth', 'verified'])->name('storeQuestion');
Route::delete('/questions/{id}', [superadminController::class, 'deleteQuestion'])->name('questions.delete');

Route::get('/dashboard/viewSurvay', [superadminController::class, 'viewSurvay'])->middleware(['auth', 'verified'])->name('viewSurvay');



Route::get('/dashboard/viewSurvayStepOne', [superadminController::class, 'viewSurvayStepOne'])->middleware(['auth', 'verified'])->name('viewSurvayStepOne');
Route::get('/dashboard/viewSurvayStepTwo', [superadminController::class, 'viewSurvaySteptwo'])->middleware(['auth', 'verified'])->name('viewSurvaySteptwo');
Route::get('/dashboard/viewSurvayStepThree', [superadminController::class, 'viewSurvayStepthree'])->middleware(['auth', 'verified'])->name('viewSurvayStepthree');
Route::get('/dashboard/viewSurvayStepFour', [superadminController::class, 'viewSurvayStepfour'])->middleware(['auth', 'verified'])->name('viewSurvayStepfour');
Route::get('/dashboard/viewSurvayStepFive', [superadminController::class, 'viewSurvayStepfive'])->middleware(['auth', 'verified'])->name('viewSurvayStepfive');
Route::get('/dashboard/viewSurvayStepSix', [superadminController::class, 'viewSurvayStepsix'])->middleware(['auth', 'verified'])->name('viewSurvayStepsix');

Route::get('/sendSurvayInvite', [superadminController::class, 'sendSurvayInvite'])->middleware(['auth', 'verified'])->name('sendSurvayInvite');
Route::post('/assignSurvey', [superadminController::class, 'assignSurvey'])->middleware(['auth', 'verified'])->name('assignSurvey');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
