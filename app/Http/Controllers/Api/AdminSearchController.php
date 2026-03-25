<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\Newsletter;
use App\Models\News;
use App\Models\Pages;
use App\Models\Posts;
use App\Models\Program;
use App\Models\Stories;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSearchController extends Controller
{
    /**
     * Search across all admin resources
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'success' => true,
                'message' => 'Query must be at least 2 characters',
                'results' => []
            ]);
        }

        $results = [];

        // Search Users
        $users = User::where('f_name', 'LIKE', "%{$query}%")
            ->orWhere('l_name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get();

        if ($users->count() > 0) {
            $results['users'] = [
                'label' => 'Users',
                'icon' => 'lni-user',
                'items' => $users->map(fn($user) => [
                    'title' => "{$user->first_name} {$user->last_name}",
                    'subtitle' => $user->email,
                    'url' => route('admin.settings.users.show', $user->id),
                    'icon' => 'lni-user'
                ])->toArray()
            ];
        }

        // Search Donations
        $donations = Donation::where('donation_number', 'LIKE', "%{$query}%")
            ->orWhere('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get();

        if ($donations->count() > 0) {
            $results['donations'] = [
                'label' => 'Donations',
                'icon' => 'lni-dollar',
                'items' => $donations->map(fn($donation) => [
                    'title' => "Donation #{$donation->donation_number}",
                    'subtitle' => "$" . number_format($donation->total_amount, 2) . " - " . ucfirst($donation->payment_status),
                    'url' => route('admin.donations.show', $donation->donation_number),
                    'icon' => 'lni-dollar'
                ])->toArray()
            ];
        }

        // Search Programs
        $programs = Program::where('title', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get();

        if ($programs->count() > 0) {
            $results['programs'] = [
                'label' => 'Programs',
                'icon' => 'lni-heart',
                'items' => $programs->map(fn($program) => [
                    'title' => $program->title,
                    'subtitle' => "Goal: \$" . number_format($program->goal_amount, 2),
                    'url' => route('admin.programs.edit', $program->id),
                    'icon' => 'lni-heart'
                ])->toArray()
            ];
        }

        // Search Contact Messages
        $contacts = ContactMessage::where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('subject', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get();

        if ($contacts->count() > 0) {
            $results['contacts'] = [
                'label' => 'Contact Messages',
                'icon' => 'lni-envelope',
                'items' => $contacts->map(fn($contact) => [
                    'title' => "{$contact->first_name} {$contact->last_name}",
                    'subtitle' => $contact->subject,
                    'url' => route('admin.contact-messages.show', $contact->id),
                    'icon' => 'lni-envelope'
                ])->toArray()
            ];
        }

        // Search Newsletter Subscribers
        $newsletters = Newsletter::where('email', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get();

        if ($newsletters->count() > 0) {
            $results['newsletters'] = [
                'label' => 'Subscribers',
                'icon' => 'lni-mail',
                'items' => $newsletters->map(fn($newsletter) => [
                    'title' => $newsletter->email,
                    'subtitle' => ucfirst($newsletter->status),
                    'url' => route('admin.settings.newsletters.index'),
                    'icon' => 'lni-mail'
                ])->toArray()
            ];
        }

        // Search Stories
        $stories = Stories::where('title', 'LIKE', "%{$query}%")
            ->limit(3)
            ->get();

        if ($stories->count() > 0) {
            $results['stories'] = [
                'label' => 'Stories',
                'icon' => 'lni-book',
                'items' => $stories->map(fn($story) => [
                    'title' => $story->title,
                    'subtitle' => 'Story',
                    'url' => route('admin.content.pages.edit', $story->id),
                    'icon' => 'lni-book'
                ])->toArray()
            ];
        }

        // Search News
        $news = News::where('title', 'LIKE', "%{$query}%")
            ->limit(3)
            ->get();

        if ($news->count() > 0) {
            $results['news'] = [
                'label' => 'News',
                'icon' => 'lni-notepad',
                'items' => $news->map(fn($newsItem) => [
                    'title' => $newsItem->title,
                    'subtitle' => 'News',
                    'url' => route('admin.content.pages.edit', $newsItem->id),
                    'icon' => 'lni-notepad'
                ])->toArray()
            ];
        }

        return response()->json([
            'success' => true,
            'query' => $query,
            'total' => count($results),
            'results' => $results
        ]);
    }
}
