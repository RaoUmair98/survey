<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::truncate();
        $questions = [
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => null,
                'questionText' => 'Consistently offers guidance and support without judgement and truly nurtures the working relationships with and amongst the team.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => null,
                'questionText' => 'Sets and achieves goals, meets deadlines, and will keep stakeholders updated throughout projects.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => null,
                'questionText' => 'Provides clear and objective feedback on an on-going basis.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => null,
                'questionText' => 'Maintains accurate supervision records, is available when needed, and acts when needed.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => null,
                'questionText' => 'Demonstrates and consistently uses relevant clinical, and/or professional knowledge with an understanding of evidence-based informed practices or professional guidelines.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => null,
                'questionText' => 'Is open to discussing feedback, areas of opportunity and listening to ideas from others.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => null,
                'questionText' => 'Shows a strong dedication to Health and Safety. Discusses safety plans, and areas of opportunity and identifies solutions for accidents or near misses. This area includes providing a psychologically safe workplace.',
                'questionLegend' => null
            ],

            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Continuous Improvement Leading with a LEAN and Agile Mindset',
                'questionText' => 'Demonstrates ability to manage change with a positive mindset and ensure any areas of opportunity are discussed with an open mindset. Leads oneself and team with a LEAN and AGILE mindset.',
                'questionLegend' => 'Agile leadership - flexible, dynamic Lean Six Sigma - organizational effectiveness, efficiency'
            ],
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Continuous Improvement Leading with a LEAN and Agile Mindset',
                'questionText' => 'Demonstrates an understanding of Emotional Intelligence (EQ) principles and uses them to foster positive relationships, to handle conflict and to exhibit resilience in the face of change or adversity.',
                'questionLegend' => null
            ],

            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Leads with an Engaged Mindset Psychological Safety Awareness',
                'questionText' => 'Shows genuine concern for the staff, client/family and treats everyone with empathy, kindness, consistency, and care.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Leads with an Engaged Mindset Psychological Safety Awareness',
                'questionText' => 'Listens with care and intent and responds within a reasonable timeframe with the correct information.',
                'questionLegend' => null
            ],


            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Leads with cultural and bias awareness',
                'questionText' => 'Support and guidance is received when required within areas of EDI for Woodview.',
                'questionLegend' => null
            ],

            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Leads with cultural and bias awareness',
                'questionText' => ' Training is offered that meets the needs of the agency and departments in all areas.',
                'questionLegend' => null
            ],

            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Innovation & Financial Awareness',
                'questionText' => 'Displays the initiative to seek support to facilitate understanding and awareness within their area(s).',
                'questionLegend' => null
            ],
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Innovation & Financial Awareness',
                'questionText' => 'Adapts to changing circumstances and embraces new technologies, methods, or processes to drive continuous improvement and enhance organizational innovation.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 1,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Innovation & Financial Awareness',
                'questionText' => 'Will seek out opportunities for positive change, process improvements and cost savings (understands budget process and makes decisions with financial capabilities in mind).',
                'questionLegend' => null
            ],

            //part III

            [
                'survey_id' => 1,
                'part' => 'Part III',
                'partTitle' => 'Additional Activities & Successes',
                'subTitle' => null,
                'questionText' => 'Indicate any additional responsibilities or activities outside of your regular role. E.g. Committee involvement, trainer, volunteer at events etc.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 1,
                'part' => 'Part III',
                'partTitle' => 'Additional Activities & Successes',
                'subTitle' => null,
                'questionText' => 'Share any accomplishments you are proud of and would like to have recorded. Ex., Client wins, special projects, development goals met.',
                'questionLegend' => null
            ],

            //part IV
            [
                'survey_id' => 1,
                'part' => 'Part IV',
                'partTitle' => 'Manager and Agency Feedback',
                'subTitle' => null,
                'questionText' => 'How can your Director support you?',
                'questionLegend' => 'Share 1 specific thing that your manager is not currently doing that they can begin doing to support you?
                Ex.Bi weekly check-ins via email, video or in person, Scheduled time off floor to participate in committees or develop',

            ],
            [
                'survey_id' => 1,
                'part' => 'Part IV',
                'partTitle' => 'Manager and Agency Feedback',
                'subTitle' => null,
                'questionText' => 'List two recommendations that could improve Woodview as a service provider and/or employer.',
                'questionLegend' => 'Ex.Provide more opportunities for feedback,Software or training recommendations',
            ],

            //part V

            [
                'survey_id' => 1,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 1:',
                'questionText' => 'Actions needed to achieve this goal. Be Specific.',
                'questionLegend' => null,
            ],
            [
                'survey_id' => 1,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 1:',
                'questionText' => 'Outcomes/Measurement:',
                'questionLegend' => ' How will I know when this goal has been accomplished?',
            ],
            [
                'survey_id' => 1,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 1:',
                'questionText' => 'Check-In Date:',
                'questionLegend' => 'Employee is responsible for establishing this date with their manager.',
            ],


            [
                'survey_id' => 1,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 2:',
                'questionText' => 'Actions needed to achieve this goal. Be Specific.',
                'questionLegend' => null,
            ],
            [
                'survey_id' => 1,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 2:',
                'questionText' => 'Outcomes/Measurement:',
                'questionLegend' => ' How will I know when this goal has been accomplished?',
            ],
            [
                'survey_id' => 1,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 2:',
                'questionText' => 'Check-In Date:',
                'questionLegend' => 'Employee is responsible for establishing this date with their manager.',
            ],



            [
                'survey_id' => 1,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 3:',
                'questionText' => 'Actions needed to achieve this goal. Be Specific.',
                'questionLegend' => null,
            ],
            [
                'survey_id' => 1,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 3:',
                'questionText' => 'Outcomes/Measurement:',
                'questionLegend' => ' How will I know when this goal has been accomplished?',
            ],
            [
                'survey_id' => 1,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 3:',
                'questionText' => 'Check-In Date:',
                'questionLegend' => 'Employee is responsible for establishing this date with their manager.',
            ],

            [
                'survey_id' => 1,
                'part' => 'Part VI',
                'partTitle' => 'Director Comments',
                'subTitle' => null,
                'questionText' => 'Comments:',
                'questionLegend' => null,
            ],




            //survay 2

            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Accountability',
                'questionText' => 'Works according to the job description, Organizational Policies and Professional Guidelines.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Accountability',
                'questionText' => 'Sets and achieves goals, meets deadlines, organizes and sources information/resources when required.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Accountability',
                'questionText' => 'Maintains reliable attendance and punctuality records, prepared for the work day, on time for meetings, duties, case conferences etc.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Accountability',
                'questionText' => 'Completes paperwork and administrative work accurately and on time with minimal reminding. I.e. payroll, email, Dayforce, EMHWare reports, consents, treatment plans and other documentation.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Accountability',
                'questionText' => 'Demonstrates and consistently uses relevant clinical, and/or professional knowledge with an understanding of evidence-based informed practices or professional guidelines.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Accountability',
                'questionText' => 'Effectively communicates with both managers and colleagues about any potential deadline challenges or project risks, demonstrating sound judgment.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Accountability',
                'questionText' => 'Shows a strong dedication to Health and Safety, utilizing the proper channels for reporting incidents.',
                'questionLegend' => null
            ],

            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Collaboration',
                'questionText' => 'Works cooperatively with team and other staff members. I.e. sharing responsibilities equally, supporting and motivating others and acknowledging/celebrating common achievements.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Collaboration',
                'questionText' => 'Demonstrates an understanding of Emotional Intelligence (EQ) principles and uses them to foster positive relationships, to handle conflict and to exhibit resilience in the face of change or adversity.',
                'questionLegend' => null
            ],

            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Compassion',
                'questionText' => 'Shows genuine concern for the client/family and treats them with empathy, kindness and care.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Compassion',
                'questionText' => ' Responds to clients/family in a timely manner.',
                'questionLegend' => null
            ],


            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Inclusion',
                'questionText' => 'Is open minded, embraces diversity and treats everyone fairly with dignity and respect.',
                'questionLegend' => null
            ],

            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' =>  'Inclusion',
                'questionText' => 'Supports the organizations EDI initiatives.',
                'questionLegend' => null
            ],

            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Innovation',
                'questionText' => 'Displays the initiative to seek support to facilitate personal growth and development within their role.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Innovation',
                'questionText' => 'Adapts to changing circumstances and embraces new technologies, methods, or processes to drive continuous improvement and enhance organizational innovation.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part II',
                'partTitle' => 'Evaluation of Woodview’s Leadership Based Competencies',
                'subTitle' => 'Innovation',
                'questionText' => 'Up to date on mandatory training (see Training Matrix).',
                'questionLegend' => null
            ],

            //part III

            [
                'survey_id' => 2,
                'part' => 'Part III',
                'partTitle' => 'Additional Activities & Successes',
                'subTitle' => null,
                'questionText' => 'Indicate any additional responsibilities or activities outside of your regular role. E.g. Committee involvement, trainer, volunteer at events etc.',
                'questionLegend' => null
            ],
            [
                'survey_id' => 2,
                'part' => 'Part III',
                'partTitle' => 'Additional Activities & Successes',
                'subTitle' => null,
                'questionText' => 'Share any accomplishments you are proud of and would like to have recorded. Ex., Client wins, special projects, development goals met.',
                'questionLegend' => null
            ],

            //part IV
            [
                'survey_id' => 2,
                'part' => 'Part IV',
                'partTitle' => 'Manager and Agency Feedback',
                'subTitle' => null,
                'questionText' => 'How can your Director support you?',
                'questionLegend' => 'Share 1 specific thing that your manager is not currently doing that they can begin doing to support you?
                Ex.Bi weekly check-ins via email, video or in person, Scheduled time off floor to participate in committees or develop',

            ],
            [
                'survey_id' => 2,
                'part' => 'Part IV',
                'partTitle' => 'Manager and Agency Feedback',
                'subTitle' => null,
                'questionText' => 'List two recommendations that could improve Woodview as a service provider and/or employer.',
                'questionLegend' => 'Ex.Provide more opportunities for feedback,Software or training recommendations',
            ],

            //part V

            [
                'survey_id' => 2,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 1:',
                'questionText' => 'Actions needed to achieve this goal. Be Specific.',
                'questionLegend' => null,
            ],
            [
                'survey_id' => 2,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 1:',
                'questionText' => 'Outcomes/Measurement:',
                'questionLegend' => ' How will I know when this goal has been accomplished?',
            ],
            [
                'survey_id' => 2,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 1:',
                'questionText' => 'Check-In Date:',
                'questionLegend' => 'Employee is responsible for establishing this date with their manager.',
            ],


            [
                'survey_id' => 2,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 2:',
                'questionText' => 'Actions needed to achieve this goal. Be Specific.',
                'questionLegend' => null,
            ],
            [
                'survey_id' => 2,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 2:',
                'questionText' => 'Outcomes/Measurement:',
                'questionLegend' => ' How will I know when this goal has been accomplished?',
            ],
            [
                'survey_id' => 2,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 2:',
                'questionText' => 'Check-In Date:',
                'questionLegend' => 'Employee is responsible for establishing this date with their manager.',
            ],



            [
                'survey_id' => 2,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 3:',
                'questionText' => 'Actions needed to achieve this goal. Be Specific.',
                'questionLegend' => null,
            ],
            [
                'survey_id' => 2,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 3:',
                'questionText' => 'Outcomes/Measurement:',
                'questionLegend' => ' How will I know when this goal has been accomplished?',
            ],
            [
                'survey_id' => 2,
                'part' => 'Part V',
                'partTitle' => 'Development and Goals',
                'subTitle' => 'Goal/Development 3:',
                'questionText' => 'Check-In Date:',
                'questionLegend' => 'Employee is responsible for establishing this date with their manager.',
            ],

            [
                'survey_id' => 2,
                'part' => 'Part VI',
                'partTitle' => 'Director Comments',
                'subTitle' => null,
                'questionText' => 'Comments:',
                'questionLegend' => null,
            ],




        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
