<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LoginPartenaireRequest;

class AuthenticatedPartenaireController extends Controller
{
    public function __construct()
    {
        if (Auth::guard('partenaire')->check()) {
            redirect()->route('partenaire.dashboard')->send();
        }
    }
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginPartenaireRequest $request): RedirectResponse
    {
        // dd('Méthode store atteinte', $request->all());

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('partenaire.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('partenaire')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
