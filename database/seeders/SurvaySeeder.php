<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\SurveyCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SurvaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Delete data instead of truncating
        DB::table('survey_categories')->truncate();
        $this->command->warn("Survey Category table truncated!");

        DB::table('surveys')->truncate();
        $this->command->warn("Survey table truncated!");


        SurveyCategory::create(['name' => 'jan']);
        SurveyCategory::create(['name' => 'feb']);

        $this->command->info("Survey Category 'jan' ,'feb' seeded successfully!");

        $faker = Faker::create();

        // Get category ids
        $janCategoryId = SurveyCategory::where('name', 'jan')->first()->id;
        $febCategoryId = SurveyCategory::where('name', 'feb')->first()->id;

        $user = User::where('role_id', 1)->first();

        $descreption1 = "
        * I have reviewed my job description<br>
        * I am up to date with training requirements which include role specific, H&S related training and IT<br>
        <p>Every year in February and March, we have performance reviews. They start on February 1st and must be finished by the end of March. This means we need to complete the review, talk with our manager about it, and mark it as done in the system.</p>
        <p>The annual performance review encompasses Woodview's Values and competencies needed to do your job effectively.</P>
        <p>In each section of the review, please rate yourself according to the Evaluation Scale. After you've completed your self-assessment, your manager will receive a notification to complete the review and meet with you. Use the online platform to document comments, discuss development updates, and record any other relevant information. There is no need to send physical documents to HR.</p>
        <p>Please keep in mind that comments do not need to be completed for all areas. Utilize the comment areas to share specific examples related to the competency being rated. Additionally, use the review process to identify areas for development and set goals for the upcoming performance period.</p>";
        

        $descreption2 = "
        * I have reviewed my job description<br>
        * I am up to date with training requirements which include role specific, H&S related training and IT<br>
        <p>Every year in February and March, we have performance reviews. They start on February 1st and must be finished by the end of March. This means we need to complete the review, talk with our manager about it, and mark it as done in the system.</p>
        <p>The annual performance review encompasses Woodview's Values and competencies needed to do your job effectively.</P>
        <p>In each section of the review, please rate yourself according to the Evaluation Scale. After you've completed your self-assessment, your manager will receive a notification to complete the review and meet with you. Use the online platform to document comments, discuss development updates, and record any other relevant information. There is no need to send physical documents to HR.</p>
        <p>Please keep in mind that comments do not need to be completed for all areas. Utilize the comment areas to share specific examples related to the competency being rated. Additionally, use the review process to identify areas for development and set goals for the upcoming performance period.</p>";

        // Create 25 surveys

            $endDate = $faker->dateTimeBetween('now', '+1 year');
            Survey::create([
                'title' => "360 Leadership Performance Review",
                'description' => $descreption1,
                'user_id' => $user->id, // Assuming users exist
                'category_id' => 1,
                'end_date' => $endDate,
                'status' => 'active'
            ]);

            Survey::create([
                'title' => "Welcome to your Performance Review",
                'description' => $descreption2,
                'user_id' => $user->id, // Assuming users exist
                'category_id' => 2,
                'end_date' => $endDate,
                'status' => 'active'
            ]);

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->command->info('Survay seeded successfully!');
        $this->command->info('Developed by Swapin Vidya (c) 2024 for LaravelOne.in.');
    }
}
