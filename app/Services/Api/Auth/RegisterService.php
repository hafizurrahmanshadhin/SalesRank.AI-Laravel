<?php

namespace App\Services\Api\Auth;

use App\Models\Consultant;
use App\Models\User;
use App\Services\Api\AI\AIConsultantRanker;
use Exception;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterService {
    /**
     * Register a new user and create a profile.
     *
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function register(array $data): array {
        $existingUser = User::where('email', $data['email'])->exists();
        if ($existingUser) {
            throw new Exception('The email has already been taken.');
        }

        try {
            // Create user with role
            $user = User::create([
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'user_name'         => $data['user_name'],
                'email'             => $data['email'],
                'email_verified_at' => now(),
                'password'          => bcrypt($data['password']),
                'role'              => $data['role'],
            ]);

            // Create profile
            $user->profile()->create([
                'phone_number'            => $data['phone_number'],
                'linkedin_profile_url'    => $data['linkedin_profile_url'] ?? null,
                'revenue_generated_year'  => $data['revenue_generated_year'] ?? null,
                'revenue_generated'       => $data['revenue_generated'] ?? null,
                'industry_experience'     => $data['industry_experience'] ?? null,
                'present_club_experience' => $data['present_club_experience'] ?? null,
                'lead_close_ratio'        => $data['lead_close_ratio'] ?? null,
            ]);

            if ($user->role === 'sales_professional') {
                // map whatever fields you’re collecting at registration…
                $consultant = Consultant::create([
                    'user_id'              => $user->id,
                    'linkedin_url'         => $data['linkedin_profile_url'] ?? null,
                    'full_name'            => "{$data['first_name']} {$data['last_name']}",
                    // use the "working_role" field as the job title
                    'job_title'            => $data['working_role'] ?? null,
                    // if you collect current_company on registration, or drop it if not:
                    'company'              => $data['current_company'] ?? null,
                    // if you collect industry on registration:
                    'industry'             => $data['industry'] ?? null,
                    // map industry_experience → total_experience
                    'total_experience'     => (int) ($data['industry_experience'] ?? 0),
                    // map present_club_experience → tenure
                    'tenure'               => (int) ($data['present_club_experience'] ?? 0),
                    // performance_keywords, achievements, revenue_closed, college_degree, location:
                    'performance_keywords' => $data['performance_keywords'] ?? false,
                    'achievements'         => $data['achievements'] ?? null,
                    'revenue_closed'       => $data['revenue_closed'] ?? null,
                    'college_degree'       => $data['has_college_degree'] ?? false,
                    'location'             => $data['location'] ?? null,
                    // ai_score + ranking_level left null until ranker runs
                ]);

                // Wrap AI scoring in its own try/catch so that
                // if it fails (missing "choices" etc.), registration still succeeds.
                try {
                    app(AIConsultantRanker::class)->score($consultant);
                } catch (Exception $e) {
                    // Log and move on—don’t abort registration just because AI scoring failed
                    Log::warning('[AIConsultantRanker] scoring failed for consultant '
                        . $consultant->id . ': ' . $e->getMessage());
                }
            }

        } catch (Exception $e) {
            throw new Exception('User registration failed: ' . $e->getMessage());
        }

        try {
            $token = JWTAuth::attempt([
                'email'    => $data['email'],
                'password' => $data['password'],
            ]);

            if (!$token) {
                throw new Exception('Authentication failed.');
            }
        } catch (JWTException $e) {
            throw new Exception('Could not create token: ' . $e->getMessage());
        }

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
}
