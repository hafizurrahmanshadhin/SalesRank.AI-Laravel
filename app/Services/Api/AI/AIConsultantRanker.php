<?php

namespace App\Services\Api\AI;

use App\Models\Consultant;
use Illuminate\Support\Facades\Http;

class AIConsultantRanker {
    public function score(Consultant $consultant) {
        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model'    => 'gpt-4',
                'messages' => [
                    [
                        'role'    => 'system',
                        'content' => 'You are a sales performance evaluator. Based on input data, give a numeric score (0–100) and classify the consultant as one of: Elite Consultant, High Performer, Strong Consultant, Average Performer, Needs Improvement.',
                    ],
                    [
                        'role'    => 'user',
                        'content' => "
                            Name: {$consultant->full_name}
                            Job Title: {$consultant->job_title}
                            Experience: {$consultant->total_experience} years
                            Tenure: {$consultant->tenure} years
                            Performance Keywords: " . ($consultant->performance_keywords ? 'Yes' : 'No') . "
                            Achievements: {$consultant->achievements}
                            Revenue Closed: {$consultant->revenue_closed}
                            Education: " . ($consultant->college_degree ? 'Yes' : 'No') . "
                        ",
                    ],
                ],
            ]);

        $aiResult = $response->json()['choices'][0]['message']['content'];

        // Extract score and rank from AI response
        preg_match('/(\d{1,3})/', $aiResult, $scoreMatch);
        preg_match('/(Elite Consultant|High Performer|Strong Consultant|Average Performer|Needs Improvement)/', $aiResult, $rankMatch);

        $consultant->ai_score      = $scoreMatch[1] ?? null;
        $consultant->ranking_level = $rankMatch[1] ?? null;
        $consultant->save();

        return $consultant;
    }
}
