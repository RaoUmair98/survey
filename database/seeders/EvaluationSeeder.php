<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Evaluation::truncate();
        // Define data to be inserted
        $evaluations = [
            [
                'survey_id' => 1,
                'abbreviation' => 'EE',
                'fullForm' => 'EXCEEDS EXPECTATION',
                'description' => 'The employee consistently goes above and beyond what is required',
            ],
            [
                'survey_id' => 1,
                'abbreviation' => 'ME',
                'fullForm' => 'MEETS EXPECTATION',
                'description' => 'The employee fully meets the requirements of the position and performance is consistent, which results in achieving established standards on a regular basis.',
            ],
            [
                'survey_id' => 1,
                'abbreviation' => 'TR',
                'fullForm' => 'TRAINING IN THE ROLE',
                'description' => 'The employee is new to this role or project. Therefore, is not expected to have met the expectations at this time.',
            ],
            [
                'survey_id' => 1,
                'abbreviation' => 'FD',
                'fullForm' => 'FURTHER DEVELOPING/AREA OF GROWTH',
                'description' => 'Further development is required in order to meet job duties and expectations within a specified area (role/project). Any area scored with FD is required to be a part of the development plan.',
            ],

            [
                'survey_id' => 2,
                'abbreviation' => 'EE',
                'fullForm' => 'EXCEEDS EXPECTATION',
                'description' => 'The employee consistently goes above and beyond what is required',
            ],
            [
                'survey_id' => 2,
                'abbreviation' => 'ME',
                'fullForm' => 'MEETS EXPECTATION',
                'description' => 'The employee fully meets the requirements of the position and performance is consistent, which results in achieving established standards on a regular basis.',
            ],
            [
                'survey_id' => 2,
                'abbreviation' => 'TR',
                'fullForm' => 'TRAINING IN THE ROLE',
                'description' => 'The employee is new to this role or project. Therefore, is not expected to have met the expectations at this time.',
            ],
            [
                'survey_id' => 2,
                'abbreviation' => 'FD',
                'fullForm' => 'FURTHER DEVELOPING/AREA OF GROWTH',
                'description' => 'Further development is required in order to meet job duties and expectations within a specified area (role/project). Any area scored with FD is required to be a part of the development plan.',
            ],
        ];

        // Insert data into the database
        Evaluation::insert($evaluations);
    }
}
