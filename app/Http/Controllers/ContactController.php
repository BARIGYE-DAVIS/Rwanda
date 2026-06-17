<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the contact form
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
 * Store a new contact message
 */
public function store(Request $request)
{
    try {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp_number' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'number_of_people' => 'nullable|integer|min:1|max:100',
            'number_of_days' => 'nullable|integer|min:1|max:365',
            'accommodation_type' => 'nullable|array',
            'accommodation_type.*' => 'in:budget,mid_range,luxury',
            'preferred_travel_date' => 'nullable|string|max:255',
            'estimated_budget' => 'nullable|numeric|min:0|max:9999999.99',
            'additional_comments' => 'nullable|string|max:5000',
        ], [
            'first_name.required' => 'Please enter your first name.',
            'first_name.max' => 'First name cannot exceed 255 characters.',
            'last_name.required' => 'Please enter your last name.',
            'last_name.max' => 'Last name cannot exceed 255 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot exceed 255 characters.',
            'whatsapp_number.max' => 'WhatsApp number cannot exceed 50 characters.',
            'nationality.max' => 'Nationality cannot exceed 255 characters.',
            'destination.max' => 'Destination cannot exceed 255 characters.',
            'number_of_people.integer' => 'Number of people must be a valid number.',
            'number_of_people.min' => 'Number of people must be at least 1.',
            'number_of_days.integer' => 'Number of days must be a valid number.',
            'number_of_days.min' => 'Number of days must be at least 1.',
            'accommodation_type.array' => 'Invalid accommodation type format.',
            'accommodation_type.*.in' => 'Invalid accommodation type selected.',
            'estimated_budget.numeric' => 'Budget must be a valid number.',
            'estimated_budget.min' => 'Budget cannot be negative.',
            'additional_comments.max' => 'Comments cannot exceed 5000 characters.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the errors below and try again.');
        }

        // Create the contact message record
        $contactMessage = ContactMessage::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'whatsapp_number' => $request->input('whatsapp_number'),
            'nationality' => $request->input('nationality'),
            'destination' => $request->input('destination'),
            'number_of_people' => $request->input('number_of_people'),
            'number_of_days' => $request->input('number_of_days'),
            'accommodation_type' => $request->input('accommodation_type'),
            'preferred_travel_date' => $request->input('preferred_travel_date'),
            'estimated_budget' => $request->input('estimated_budget'),
            'additional_comments' => $request->input('additional_comments'),
            'status' => 'pending',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Send notification email to ADMIN ONLY
        try {
            $adminEmail = config('mail.admin_email', 'admin@calmafricasafaris.com');

            Mail::send('emails.contact-notification', [
                'contact' => $contactMessage
            ], function ($message) use ($contactMessage, $adminEmail) {
                $message->to($adminEmail)
                    ->subject('New Booking Request: ' . $contactMessage->first_name . ' ' . $contactMessage->last_name)
                    ->replyTo($contactMessage->email, $contactMessage->first_name . ' ' . $contactMessage->last_name);
            });
        } catch (\Exception $emailError) {
            // Log email error but don't fail the contact submission
            Log::error('Contact form admin email failed: ' . $emailError->getMessage());
        }

        // Return success response
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Booking Request Sent Successfully! Thank you for your booking request! We\'ll get back to you soon.',
                'contact_id' => $contactMessage->id
            ]);
        }

        return redirect()->back()->with('success', 'Booking Request Sent Successfully! Thank you for your booking request! We\'ll get back to you soon.');

    } catch (\Exception $e) {
        Log::error('Contact form submission failed: ' . $e->getMessage());

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again or contact us directly.',
                'error' => app()->environment('local') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }

        return back()
            ->withInput()
            ->with('error', 'Something went wrong. Please try again or contact us directly.');
    }
}
    /**
     * Show success page after contact form submission
     */
    public function success()
    {
        return view('contact.success');
    }

/**
 * Admin: Display all booking requests with filters
 */
public function admin(Request $request)
{
    $query = ContactMessage::query();

    // Search
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('first_name', 'LIKE', "%{$search}%")
              ->orWhere('last_name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('whatsapp_number', 'LIKE', "%{$search}%")
              ->orWhere('destination', 'LIKE', "%{$search}%")
              ->orWhere('nationality', 'LIKE', "%{$search}%")
              ->orWhere('additional_comments', 'LIKE', "%{$search}%");
        });
    }

    // Filter by Status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by Destination
    if ($request->filled('destination')) {
        $query->where('destination', $request->destination);
    }

    // Get results
    $contacts = $query->latest()->paginate(20);

    return view('admin.contacts.index', compact('contacts'));
}
    /**
     * Admin: Show specific contact message
     */
    public function show($id)
    {
        $contact = ContactMessage::findOrFail($id);

        // Mark as read if not already
        if ($contact->status === 'pending' && !$contact->read_at) {
            $contact->update(['read_at' => now()]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Admin: Update read status
     */
    public function updateReadStatus(Request $request, $id)
    {
        $contact = ContactMessage::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'is_read' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $contact->update([
            'read_at' => $request->is_read ? now() : null
        ]);

        return back()->with('success', 'Contact message status updated successfully.');
    }

    /**
     * Admin: Delete contact message
     */
    public function destroy($id)
    {
        $contact = ContactMessage::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'Contact message deleted successfully.');
    }

    /**
     * Get contact statistics (for admin dashboard)
     */
    public function getStats()
    {
        return [
            'total' => ContactMessage::count(),
            'pending' => ContactMessage::where('status', 'pending')->count(),
            'processing' => ContactMessage::where('status', 'processing')->count(),
            'quoted' => ContactMessage::where('status', 'quoted')->count(),
            'confirmed' => ContactMessage::where('status', 'confirmed')->count(),
            'cancelled' => ContactMessage::where('status', 'cancelled')->count(),
            'this_month' => ContactMessage::whereMonth('created_at', now()->month)
                                         ->whereYear('created_at', now()->year)
                                         ->count(),
            'this_week' => ContactMessage::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count(),
            'today' => ContactMessage::whereDate('created_at', today())->count(),
        ];
    }

    /**
     * Mark multiple contacts as read (bulk action)
     */
    public function bulkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_ids' => 'required|array',
            'contact_ids.*' => 'exists:contact_messages,id',
            'action' => 'required|in:mark_read,mark_unread,delete'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $contactIds = $request->contact_ids;

        switch ($request->action) {
            case 'mark_read':
                ContactMessage::whereIn('id', $contactIds)->update(['read_at' => now()]);
                $message = 'Selected messages marked as read.';
                break;

            case 'mark_unread':
                ContactMessage::whereIn('id', $contactIds)->update(['read_at' => null]);
                $message = 'Selected messages marked as unread.';
                break;

            case 'delete':
                ContactMessage::whereIn('id', $contactIds)->delete();
                $message = 'Selected messages deleted.';
                break;
        }

        return back()->with('success', $message);
    }

    /**
     * Export contact messages to CSV (for admin)
     */
    public function export(Request $request)
    {
        $query = ContactMessage::query();

        // Apply filters if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('destination')) {
            $query->where('destination', $request->destination);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $contacts = $query->latest()->get();

        $filename = 'contact-messages-' . now()->format('Y-m-d-H-i-s') . '.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, [
                'ID', 'First Name', 'Last Name', 'Full Name', 'Email', 'WhatsApp Number',
                'Nationality', 'Destination', 'Number of People', 'Number of Days',
                'Accommodation Type', 'Preferred Travel Date', 'Estimated Budget',
                'Additional Comments', 'Status', 'Created At'
            ]);

            // CSV data
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->first_name,
                    $contact->last_name,
                    $contact->full_name,
                    $contact->email,
                    $contact->whatsapp_number,
                    $contact->nationality,
                    $contact->destination,
                    $contact->number_of_people,
                    $contact->number_of_days,
                    $contact->accommodation_list,
                    $contact->preferred_travel_date,
                    $contact->formatted_budget,
                    $contact->additional_comments,
                    $contact->status_label,
                    $contact->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get countries with message counts
     */
    public function getCountryStats()
    {
        return ContactMessage::whereNotNull('destination')
                            ->selectRaw('destination, COUNT(*) as count')
                            ->groupBy('destination')
                            ->orderBy('count', 'desc')
                            ->pluck('count', 'destination')
                            ->toArray();
    }

    /**
     * Search contact messages
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $contacts = ContactMessage::where('first_name', 'LIKE', "%{$search}%")
                                 ->orWhere('last_name', 'LIKE', "%{$search}%")
                                 ->orWhere('email', 'LIKE', "%{$search}%")
                                 ->orWhere('whatsapp_number', 'LIKE', "%{$search}%")
                                 ->orWhere('destination', 'LIKE', "%{$search}%")
                                 ->orWhere('nationality', 'LIKE', "%{$search}%")
                                 ->latest()
                                 ->paginate(20);

        return view('admin.contacts.index', compact('contacts', 'search'));
    }

    /**
 * Admin: Update booking status
 */
public function updateStatus(Request $request, $id)
{
    $contact = ContactMessage::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'status' => 'required|in:pending,processing,quoted,confirmed,cancelled'
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator);
    }

    $contact->update([
        'status' => $request->status,
        'read_at' => in_array($request->status, ['processing', 'quoted', 'confirmed']) ? now() : $contact->read_at
    ]);

    return back()->with('success', 'Booking status updated successfully.');
}

}