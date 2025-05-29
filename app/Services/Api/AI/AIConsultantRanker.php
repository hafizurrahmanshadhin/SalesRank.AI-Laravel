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

    // public function score(Consultant $consultant): void {
    //     // 1) Build your prompt or payload however you need...
    //     $payload = [
    //         'model'    => 'gpt-3.5-turbo', // or 'gpt-4' if you have access
    //         'messages' => [
    //             [
    //                 'role'    => 'system',
    //                 'content' => 'You are an AI that ranks sales professionals...',
    //             ],
    //             [
    //                 'role'    => 'user',
    //                 'content' => "Evaluate {$consultant->full_name}...",
    //             ],
    //         ],
    //     ];

    //     // 2) Send to OpenAI (use your configured API key)
    //     $response = Http::withToken(config('services.chat_gpt.key'))
    //         ->timeout(10)
    //         ->post('https://api.openai.com/v1/chat/completions', $payload);

    //     $body = $response->json();

    //     // 3) Defensive check: do we actually have a choices[0].message.content?
    //     if (!isset($body['choices'][0]['message']['content'])) {
    //         // Log the entire response so you can debug later
    //         Log::error('[AIConsultantRanker] unexpected OpenAI response', [
    //             'status'   => $response->status(),
    //             'body_raw' => $response->body(),
    //         ]);

    //         throw new Exception('OpenAI did not return any choices.');
    //     }

    //     $aiReply = $body['choices'][0]['message']['content'];

    //     // 4) Parse your AI reply to extract the score & ranking
    //     //    (example assumes the model returns JSON with { "score": xx, "level": "Good" })
    //     $parsed = json_decode($aiReply, true);
    //     if (json_last_error() !== JSON_ERROR_NONE || !isset($parsed['score'], $parsed['level'])) {
    //         Log::error('[AIConsultantRanker] malformed AI reply', [
    //             'reply' => $aiReply,
    //         ]);
    //         throw new Exception('Could not parse AI response.');
    //     }

    //     // 5) Save back onto the consultant
    //     $consultant->ai_score      = $parsed['score'];
    //     $consultant->ranking_level = $parsed['level'];
    //     $consultant->save();
    // }
}
