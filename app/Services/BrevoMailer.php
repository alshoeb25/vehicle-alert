<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BrevoMailer
{
    /**
     * Send an email via Brevo transactional API.
     */
    public static function send(string $toEmail, string $subject, string $htmlContent, ?string $toName = null, ?string $replyTo = null, array $tags = []): void
    {
        $senderEmail = config('services.brevo.sender_email') ?: config('mail.from.address');
        $senderName = config('services.brevo.sender_name') ?: config('mail.from.name');

        if (!$senderEmail) {
            Log::warning('Brevo SMTP sender email not configured. Skipping email send.', [
                'to' => $toEmail,
                'subject' => $subject,
            ]);
            return;
        }

        try {
            Mail::mailer(config('mail.default', 'smtp'))
                ->html($htmlContent, function ($message) use ($toEmail, $toName, $subject, $replyTo, $senderEmail, $senderName, $tags) {
                    $message->to($toEmail, $toName ?: $toEmail)
                        ->subject($subject)
                        ->from($senderEmail, $senderName);

                    if ($replyTo) {
                        $message->replyTo($replyTo);
                    }

                    if (!empty($tags)) {
                        // Brevo accepts X-Mailin tags over SMTP.
                        $message->getHeaders()->addTextHeader('X-Mailin-Tag', implode(',', $tags));
                    }
                });
        } catch (\Throwable $e) {
            Log::error('Brevo SMTP send failed', [
                'to' => $toEmail,
                'subject' => $subject,
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException('Failed to send email via Brevo SMTP.');
        }
    }
}
