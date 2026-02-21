<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NewsletterController extends Controller
{
    /**
     * Display a listing of newsletter subscribers with search/filter
     */
    public function index(Request $request)
    {
        $query = Newsletter::query();

        // Search by email
        if ($search = $request->input('search')) {
            $query->where('email', 'like', '%' . trim($search) . '%');
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $subscribers = $query->latest()->paginate(20);

        return view('admin.newsletters.index', compact('subscribers'));
    }

    /**
     * Toggle subscriber status (subscribe ↔ unsubscribe)
     */
    public function toggleStatus(Request $request, Newsletter $newsletter)
    {
        $newStatus = $newsletter->status === 'subscribed' ? 'unsubscribed' : 'subscribed';

        $newsletter->update([
            'status' => $newStatus,
            $newStatus === 'subscribed' ? 'subscribed_at' : 'unsubscribed_at' => now(),
        ]);

        return redirect()
            ->route('admin.settings.newsletters.index')
            ->with('success', 'Subscriber status updated successfully.');
    }

    /**
     * Export all subscribers to CSV
     */
    public function export()
    {
        $subscribers = Newsletter::all();

        $headers = [
            'Content-Type'        => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="newsletters-' . now()->format('Y-m-d-His') . '.csv"',
        ];

        $callback = function () use ($subscribers) {
            $file = fopen('php://output', 'w');

            // Add UTF-8 BOM for proper Excel display
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header row
            fputcsv($file, [
                'ID',
                'Email',
                'Status',
                'Subscribed At',
                'Unsubscribed At',
                'Created At',
            ]);

            // Data rows
            foreach ($subscribers as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->email,
                    ucfirst($row->status),
                    $row->subscribed_at ? $row->subscribed_at->format('Y-m-d H:i:s') : '-',
                    $row->unsubscribed_at ? $row->unsubscribed_at->format('Y-m-d H:i:s') : '-',
                    $row->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}