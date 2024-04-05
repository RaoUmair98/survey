<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DirectorSurveyController extends Controller
{
    public function index($manager,$manager_id){
        $manager = User::find($manager_id);
        $subordinates = $manager->subordinates();
        return view('director.employee_progress',compact(['subordinates']));
    }
}
