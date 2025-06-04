<?php

namespace App\Http\Controllers;

use App\Models\BannerSection;
use App\Models\ConnectInfo;
use App\Models\Expertise;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfessorAuthController extends Controller
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

        if (Auth::guard('professor')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // return redirect('/');
            return redirect()->back()->with('success', 'You have successfully logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegisterForm()
    {
        $expertises = Expertise::all(); // Fetch all expertises
        $info = ConnectInfo::firstOrFail();
        $banner = BannerSection::firstOrFail();
        return view('layouts.pages.create-professor-account', compact('expertises', 'info', 'banner'));
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'teaching_type' => 'required|string|in:fixed_time,permanent',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:professors,email|unique:students,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|regex:/^\+?[0-9\- ]+$/|min:8|max:20',
            'linked_in' => 'required_if:teaching_type,fixed_time|nullable|url',
            'country' => 'required_if:teaching_type,fixed_time|string|max:100',
            'more_info' => 'nullable|string|max:2000',
            'share_data' => 'nullable|boolean',
            'teaching_mode' => 'required_if:teaching_type,fixed_time|string',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'expertises' => 'required_if:teaching_type,fixed_time|array|min:1',
            'expertises.*' => 'exists:expertises,id',
        ]);

        $professor = Professor::create([
            'teaching_type' => $validatedData['teaching_type'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'phone' => $validatedData['phone'],
            'linked_in' => $validatedData['linked_in'] ?? null,
            'country' => $validatedData['country'] ?? null,
            'more_info' => $validatedData['more_info'] ?? null,
            'share_data' => $validatedData['share_data'] ?? false,
            'teaching_mode' => $validatedData['teaching_mode'] ?? null,
            'cv' => $request->file('cv')->store('cv_uploads', 'public'),
        ]);

        $professor->expertises()->sync($validatedData['expertises'] ?? []);

        Auth::guard('professor')->login($professor);

        return redirect()->route('home')->with('success', 'Your Professor account created successfully!');
    }

    public function logout()
    {
        Auth::guard('professor')->logout();

        return redirect()->route('home')->with('success', 'You have successfully logged out!');
    }

    public function profile()
    {
        $professor = Auth::guard('professor')->user();

        return view('layouts.pages.professor.profile', compact('professor'));
    }

    public function edit()
    {
        $professor = Auth::guard('professor')->user();

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

        $teachingTypes = [
            'fixed_time' => 'Fixed Time',
            'permanent' => 'Permanent'
        ];

        $expertises = Expertise::all();

        return view('layouts.pages.professor.edit', compact('professor', 'countries', 'teachingTypes', 'expertises'));
    }

    public function update(Request $request)
    {
        $professor = Auth::guard('professor')->user();

        $validated = $request->validate([
            'teaching_type' => 'required|string|in:fixed_time,permanent',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:professors,email|unique:students,email',
            'email' => 'required|email|unique:students,email|unique:professors,email,' . $professor->id,
            'password' => 'string|min:6|confirmed',
            'phone' => 'required|string|regex:/^\+?[0-9\- ]+$/|min:8|max:20',
            'linked_in' => 'required_if:teaching_type,fixed_time|nullable|url',
            'country' => 'required_if:teaching_type,fixed_time|string|max:100',
            'more_info' => 'nullable|string|max:2000',
            'share_data' => 'nullable|boolean',
            'teaching_mode' => 'required_if:teaching_type,fixed_time|string',
            'cv' => 'file|mimes:pdf,doc,docx|max:2048',
            'expertises' => 'required_if:teaching_type,fixed_time|array|min:1',
            'expertises.*' => 'exists:expertises,id',
        ]);

        $professor->update($validated);

        $professor->expertises()->sync($validated['expertises'] ?? []);

        // Update password if provided
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $professor->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            $professor->password = Hash::make($request->new_password);
            $professor->save();
        }

        return redirect()->route('professor.profile')->with('success', 'Profile updated successfully!');
    }
}
