<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactReceivedMail;
use App\Mail\ContactAcknowledgmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

            // Send email to company
            Mail::to('wecare@inferlogics.com')
                ->send(new ContactReceivedMail($contactData));

            // Send acknowledgment email to user
            Mail::to($contact->email)
                ->send(new ContactAcknowledgmentMail($contactData));

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
