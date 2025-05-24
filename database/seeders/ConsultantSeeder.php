<?php

namespace Database\Seeders;

use App\Models\Consultant;
use App\Services\Api\AI\AIConsultantRanker;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class ConsultantSeeder extends Seeder {
    public function run(): void {
        // 1) load the CSV
        $csv = Reader::createFromPath(storage_path('app/PEO_Data_Consultants.csv'), 'r');
        $csv->setHeaderOffset(0);

        // 2) resolve the AI ranker once
        $ranker = app(AIConsultantRanker::class);

        // 3) loop & import
        foreach ($csv->getRecords() as $record) {
            // create the bare consultant
            $consultant = Consultant::create([
                'linkedin_url'         => $record['LinkedIn URL'] ?? null,
                'full_name'            => $record['Full Name'] ?? null,
                'job_title'            => $record['Current Job Title'] ?? null,
                'company'              => $record['Current Company'] ?? null,
                'industry'             => $record['Industry (PEO/HCM or Other)'] ?? null,
                'total_experience'     => (int) ($record['Total Years of Experience'] ?? 0),
                'tenure'               => (int) ($record['Tenure at Current Company'] ?? 0),
                'performance_keywords' => strtoupper($record['Performance Keywords (Y/N)'] ?? '') === 'Y',
                'achievements'         => $record['Achivments (President club, 100% Quota Etc.)'] ?? null,
                'revenue_closed'       => $record['Revenue Closed (if available)'] ?? null,
                'college_degree'       => strtoupper($record['Education (College Degree)'] ?? '') === 'YES',
                'location'             => $record['Location (City, State)'] ?? null,
                // ai_score + ranking_level left null for now
            ]);

            // 4) call your AI service to score & rank
            $ranker->score($consultant);
        }
    }
}
