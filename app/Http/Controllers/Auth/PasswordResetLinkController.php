<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Professor;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = $request->input('email');

        // Check if this email belongs to a student
        $studentExists = Student::where('email', $email)->exists();

        if ($studentExists) {
            $status = Password::broker('students')->sendResetLink(
                ['email' => $email]
            );
        } else {
            // Check if it belongs to a professor
            $professorExists = Professor::where('email', $email)->exists();

            if ($professorExists) {
                $status = Password::broker('professors')->sendResetLink(
                    ['email' => $email]
                );
            } else {
                // Neither student nor professor — show error
                return back()->withInput($request->only('email'))
                    ->withErrors(['email' => 'We could not find a user with that email address.']);
            }
        }

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
