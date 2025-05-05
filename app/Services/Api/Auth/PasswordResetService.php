<?php

namespace App\Services\Api\Auth;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetService {
    protected string $table;
    protected int $expires;

    public function __construct() {
        $this->table   = config('auth.passwords.users.table');
        $this->expires = config('auth.passwords.users.expire');
    }

    public function sendResetLink(string $email): string {
        $token = Str::random(60);

        DB::table($this->table)
            ->updateOrInsert(
                ['email' => $email],
                [
                    'token'      => Hash::make($token),
                    'created_at' => Carbon::now(),
                ]
            );

        $link = url("/reset-password?token={$token}&email=" . urlencode($email));
        Mail::to($email)->send(new ResetPasswordMail($link));
        return $link;
    }

    public function resetPassword(string $token, string $newPassword, string $email): void {
        $record = DB::table($this->table)
            ->where('email', $email)
            ->whereRaw("created_at >= ?", [Carbon::now()->subMinutes($this->expires)])
            ->first();

        if (!$record || !Hash::check($token, $record->token)) {
            throw new Exception('Invalid or expired token.', 404);
        }

        $user           = User::where('email', $record->email)->firstOrFail();
        $user->password = Hash::make($newPassword);
        $user->save();

        DB::table($this->table)->where('email', $record->email)->delete();
    }
}
