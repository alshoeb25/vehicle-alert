<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Services\BrevoMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store contact form submission
     */
    public function store(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'message' => 'required|string|max:5000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Create contact record
            $contact = Contact::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'message' => $request->input('message'),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => 'new',
            ]);

            // Prepare contact data for emails
            $contactData = [
                'id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'message' => $contact->message,
            ];

            $adminEmail = config('services.brevo.admin_email', config('mail.from.address'));

            // Send emails, but don't fail if email sending fails
            try {
                $adminHtml = view('emails.contact-received', ['contactData' => $contactData])->render();
                BrevoMailer::send(
                    $adminEmail,
                    'New Contact Form Submission - ' . $contact->name,
                    $adminHtml,
                    $contact->name,
                    $contact->email,
                    ['contact', 'admin']
                );
            } catch (\Exception $emailError) {
                \Log::error('Failed to send admin contact email: ' . $emailError->getMessage());
            }

            try {
                $verifiedRecipient = User::where('email', $contact->email)
                    ->where(function ($q) {
                        $q->where('is_email_verified', true)
                          ->orWhereNotNull('email_verified_at');
                    })
                    ->first();

                if ($verifiedRecipient) {
                    $ackHtml = view('emails.contact-acknowledgment', ['contactData' => $contactData])->render();
                    BrevoMailer::send(
                        $verifiedRecipient->email,
                        'We Received Your Message - Thank You!',
                        $ackHtml,
                        $verifiedRecipient->name ?? $contact->name,
                        null,
                        ['contact', 'customer']
                    );
                } else {
                    \Log::info('Skipping acknowledgment email because user is not verified', [
                        'email' => $contact->email,
                    ]);
                }
            } catch (\Exception $emailError) {
                \Log::error('Failed to send acknowledgment email: ' . $emailError->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been received. We will get back to you within 24 hours.',
                'contact_id' => $contact->id,
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request. Please try again later.',
            ], 500);
        }
    }
}
