<?php

namespace App\Http\Controllers\Web\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller {
    /**
     * Display the login view.
     */
    public function create(): View {
        return view('frontend.layouts.index.index');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse {
        $request->authenticate();
        $request->session()->regenerate();

        if (Auth::user()->role->slug !== 'admin') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Only admins can log in.',
            ]);
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirects the user to Google's OAuth page for authentication.
     *
     * @return RedirectResponse
     */
    public function GoogleRedirect(): RedirectResponse {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handles the callback after Google has authenticated the user.
     *
     * @return RedirectResponse
     */
    public function GoogleCallback(): RedirectResponse {
        $user = Socialite::driver('google')->user();
        dd($user);
    }
}
