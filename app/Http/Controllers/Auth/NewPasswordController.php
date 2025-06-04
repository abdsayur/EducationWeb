<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Professor;
use App\Models\Student;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = $request->input('email');

        // Check if it's a student
        $studentExists = Student::where('email', $email)->exists();

        if ($studentExists) {
            $status = Password::broker('students')->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    event(new PasswordReset($user));
                }
            );

            return $status == Password::PASSWORD_RESET
                ? redirect()->route('student.login')->with('status', __($status))
                : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        }

        // Check if it's a professor
        $professorExists = Professor::where('email', $email)->exists();

        if ($professorExists) {
            $status = Password::broker('professors')->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    event(new PasswordReset($user));
                }
            );

            return $status == Password::PASSWORD_RESET
                ? redirect()->route('professor.login')->with('status', __($status))
                : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        }

        // No user found in either students or professors
        return back()->withInput($request->only('email'))
            ->withErrors(['email' => 'We could not find a user with that email address.']);
    }
}
