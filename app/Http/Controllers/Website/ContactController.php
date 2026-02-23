<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;
use App\Mail\Website\ContactAdminNotification;
use App\Mail\Website\ContactAutoReply;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('Website.ContactUs');
    }

    public function store(ContactMessageRequest $request)
    {
        // dd($request->all());
        // Save to database
        $contactMessage = ContactMessage::create($request->validated());

        // Notify admin
        Mail::to(config('mail.from.address'))->send(
            new ContactAdminNotification($contactMessage)
        );

        // Auto reply to user
        Mail::to($contactMessage->email)->send(
            new ContactAutoReply($contactMessage)
        );

        return redirect()
            ->route('website.contact')
            ->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }
}