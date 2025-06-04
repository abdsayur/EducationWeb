<?php

namespace App\Http\Controllers;

use App\Mail\ContactAdminMail;
use App\Mail\ContactClientMail;
use App\Models\BannerSection;
use App\Models\ConnectInfo;
use App\Models\ContactUsEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function index()
    {
        $info = ConnectInfo::firstOrFail();
        $banner = BannerSection::firstOrFail();
        return view('layouts.pages.contact', compact('info', 'banner'));
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'type'       => 'required|string',
            'description' => 'required|string',
            // 'g-recaptcha-response' => 'required'
        ]);

        // recaptcha verification
        // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => env('RECAPTCHA_SECRET_KEY'),
        //     'response' => $request->input('g-recaptcha-response'),
        // ]);

        // if (!$response->json('success')) {
        //     $validator->errors()->add('g-recaptcha-response', 'Recaptcha verification failed.');
        //     return back()->withErrors($validator)->withInput();
        // }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // save message
        $contact = ContactUsEmail::create([
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'type'        => $request->type,
            'description' => $request->description,
        ]);

        // Send email to admin
        Mail::to('info@learnx.education')->send(new ContactAdminMail($contact));

        // Send confirmation email to client
        Mail::to($contact->email)->send(new ContactClientMail($contact));

        return redirect()->back()->with('success', 'Your message has been sent successfully. Thank you!');
    }
}
