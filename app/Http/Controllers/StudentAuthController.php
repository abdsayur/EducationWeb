<?php

namespace App\Http\Controllers;

use App\Models\BannerSection;
use App\Models\ConnectInfo;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        // return auth()->user()->first_name;
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('student')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended(url()->previous())->with('success', 'You have successfully logged in!');
        } elseif (Auth::guard('professor')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->route('home')->with('success', 'You have successfully logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegisterForm()
    {
        $info = ConnectInfo::firstOrFail();
        $banner = BannerSection::firstOrFail();
        return view('layouts.pages.create-student-account', compact('info', 'banner'));
    }

    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:students,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|regex:/^\+?[0-9\- ]+$/|min:8|max:20',
            'academic_year' => 'required|string',
            'country' => 'required|string|max:100',
        ]);

        // Create the student record
        $student = Student::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'academic_year' => $validatedData['academic_year'],
            'country' => $validatedData['country'],
        ]);

        // Log the student in
        Auth::guard('student')->login($student);

        // Redirect to the home page with a success message
        return redirect()->route('home')->with('success', 'Your Student account was created successfully!');
    }

    public function logout()
    {
        Auth::guard('student')->logout();

        return redirect()->route('home')->with('success', 'You have successfully logged out!');
    }

    public function profile()
    {
        $student = Auth::guard('student')->user();
        $enrolledCourses = $student->courses()->get();

        return view('layouts.pages.student-profile', compact('student', 'enrolledCourses'));
    }

    public function edit()
    {
        $student = Auth::guard('student')->user();
        $academicYears = [
            'undergraduate' => 'Undergraduate',
            'bachelor_1' => 'Bachelor - Year 1',
            'bachelor_2' => 'Bachelor - Year 2',
            'bachelor_3' => 'Bachelor - Year 3',
            'master' => 'Master',
            'master_1' => 'Master - Year 1',
            'master_2' => 'Master - Year 2',
            'phd' => 'PhD'
        ];

        $countries = [
            'AF' => 'Afghanistan',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BR' => 'Brazil',
            'BG' => 'Bulgaria',
            'CA' => 'Canada',
            'CN' => 'China',
            'CO' => 'Colombia',
            'HR' => 'Croatia',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'EG' => 'Egypt',
            'FR' => 'France',
            'DE' => 'Germany',
            'GR' => 'Greece',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IT' => 'Italy',
            'JP' => 'Japan',
            'JO' => 'Jordan',
            'KW' => 'Kuwait',
            'LB' => 'Lebanon',
            'MY' => 'Malaysia',
            'MX' => 'Mexico',
            'MA' => 'Morocco',
            'NL' => 'Netherlands',
            'NZ' => 'New Zealand',
            'NG' => 'Nigeria',
            'NO' => 'Norway',
            'PK' => 'Pakistan',
            'PH' => 'Philippines',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'QA' => 'Qatar',
            'RO' => 'Romania',
            'RU' => 'Russia',
            'SA' => 'Saudi Arabia',
            'RS' => 'Serbia',
            'SG' => 'Singapore',
            'ZA' => 'South Africa',
            'KR' => 'South Korea',
            'ES' => 'Spain',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'TH' => 'Thailand',
            'TR' => 'Turkey',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'VN' => 'Vietnam',
            'YE' => 'Yemen',
            'LB' => 'Lebanon'
        ];

        return view('layouts.pages.student.edit-profile', compact('student', 'academicYears', 'countries'));
    }

    public function update(Request $request)
    {
        $student = Auth::guard('student')->user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'academic_year' => 'required|string',
            'country' => 'required|string|size:2',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $student->update($validated);

        // Update password if provided
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $student->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            $student->password = Hash::make($request->new_password);
            $student->save();
        }

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully!');
    }
}
