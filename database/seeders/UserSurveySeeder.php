<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserSurvay;

class UserSurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSurvay::truncate();
        
        // Get all user IDs except user_id 1
        $userIds = User::where('id', '<>', 1)->pluck('id')->toArray();

        // Get all survey IDs
        $surveyIds = Survey::pluck('id')->toArray();

        // Iterate through each user ID
        foreach ($userIds as $userId) {
            // Generate a random number between 2 and 3 to assign that many surveys to each user
            $numSurveys = rand(2, 3);

            // Shuffle the survey IDs to assign random surveys to each user
            shuffle($surveyIds);

            // Take only the first $numSurveys surveys to assign to the user
            $surveysToAssign = array_slice($surveyIds, 0, $numSurveys);

            // Associate the user with the selected surveys
            foreach ($surveysToAssign as $surveyId) {
                UserSurvay::create([
                    'user_id' => $userId,
                    'survey_id' => $surveyId,
                    'percentCompleted' => rand(0, 100) // Random percent completed
                ]);
            }
        }
    }
}
