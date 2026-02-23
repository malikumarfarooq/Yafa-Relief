<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Search by name or email
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . trim($search) . '%')
                  ->orWhere('last_name', 'like', '%' . trim($search) . '%')
                  ->orWhere('email', 'like', '%' . trim($search) . '%');
            });
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Filter by date
        if ($date = $request->input('date')) {
            $query->whereDate('created_at', $date);
        }

        $messages = $query->latest()->paginate(20);

        return view('Admin.ContactMessages.Index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        return view('Admin.ContactMessages.Show', compact('contactMessage'));
    }

    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status' => 'required|in:new,replied,closed',
        ]);

        $contactMessage->update(['status' => $request->status]);

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Message status updated successfully.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }

    public function export()
    {
        $messages = ContactMessage::all();

        $headers = [
            'Content-Type'        => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="contact-messages-' . now()->format('Y-m-d-His') . '.csv"',
        ];

        $callback = function () use ($messages) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM for Excel
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($file, [
                'ID', 'First Name', 'Last Name', 'Email',
                'Phone', 'Subject', 'Message', 'Status', 'Created At',
            ]);

            foreach ($messages as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->first_name,
                    $row->last_name,
                    $row->email,
                    $row->phone ?? '-',
                    $row->subject ?? '-',
                    $row->message,
                    ucfirst($row->status),
                    $row->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}