<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\Website\NewsletterSubscriptionConfirmation;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('newsletter_error', true);
        }

        $email = strtolower(trim($request->email));

        $newsletter = Newsletter::where('email', $email)->first();

        if ($newsletter && $newsletter->status === 'subscribed') {
            return back()->with('newsletter_success', 'You are already subscribed to our newsletter!');
        }

        if ($newsletter) {
            // Re-subscribe
            $newsletter->update([
                'status'         => 'subscribed',
                'subscribed_at'  => now(),
                'unsubscribed_at'=> null,
            ]);
        } else {
            $newsletter = Newsletter::create([
                'email'         => $email,
                'status'        => 'subscribed',
                'subscribed_at' => now(),
            ]);
        }

        // Send welcome email (queued automatically because mail implements ShouldQueue)
        Mail::to($newsletter->email)
            ->queue(new NewsletterSubscriptionConfirmation($newsletter->email));

        return back()->with('newsletter_success', 'Thank you! You have been subscribed. Check your inbox!');
    }

    //  UNSUBSCRIBE
    public function unsubscribe(Request $request, $email)
    {
        if (!$request->hasValidSignature()) {
            abort(403, 'Invalid or expired unsubscribe link.');
        }

        $newsletter = Newsletter::where('email', $email)->firstOrFail();

        if ($newsletter->status === 'unsubscribed') {
            return view('website.unsubscribe', [
                'message' => 'You are already unsubscribed from our newsletter.'
            ]);
        }

        $newsletter->update([
            'status'          => 'unsubscribed',
            'unsubscribed_at' => now(),
        ]);

        return view('website.unsubscribe', [
            'message' => 'You have successfully unsubscribed from our newsletter.'
        ]);
    }
}