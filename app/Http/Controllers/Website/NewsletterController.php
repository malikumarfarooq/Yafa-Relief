<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function unsubscribe(Request $request, $email)
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid or expired unsubscribe link.');
        }

        $newsletter = Newsletter::where('email', $email)->firstOrFail();

        if ($newsletter->status === 'unsubscribed') {
            return view('website.unsubscribe', [
                'message' => 'You are already unsubscribed from our newsletter.',
            ]);
        }

        $newsletter->update([
            'status' => 'unsubscribed',
            'unsubscribed_at' => now(),
        ]);

        return view('website.unsubscribe', [
            'message' => 'You have successfully unsubscribed from our newsletter.',
        ]);
    }
}
