<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #fecc00; padding: 20px; border-radius: 5px 5px 0 0; }
        .header h2 { margin: 0; color: #1a1a1a; }
        .content { background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 0 0 5px 5px; }
        .field { margin: 15px 0; }
        .field-label { font-weight: bold; color: #fecc00; }
        .field-value { color: #333; padding: 8px 0; }
        .message-box { background-color: #fff; padding: 15px; border-left: 4px solid #fecc00; margin: 20px 0; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
        </div>
        
        <div class="content">
            <p>You have received a new contact form submission. Here are the details:</p>
            
            <div class="field">
                <div class="field-label">Name:</div>
                <div class="field-value">{{ $contactData['name'] }}</div>
            </div>
            
            <div class="field">
                <div class="field-label">Email:</div>
                <div class="field-value"><a href="mailto:{{ $contactData['email'] }}">{{ $contactData['email'] }}</a></div>
            </div>
            
            @if($contactData['phone'])
            <div class="field">
                <div class="field-label">Phone:</div>
                <div class="field-value">{{ $contactData['phone'] }}</div>
            </div>
            @endif
            
            <div class="message-box">
                <div class="field-label">Message:</div>
                <div class="field-value">{{ $contactData['message'] }}</div>
            </div>
            
            <div class="field">
                <div class="field-label">Contact ID:</div>
                <div class="field-value">#{{ $contactData['id'] }}</div>
            </div>
            
            <div class="footer">
                <p>Please reply to this email or contact the visitor directly to address their inquiry.</p>
                <p>This is an automated email from your RESPO QR Codes contact form.</p>
            </div>
        </div>
    </div>
</body>
</html>
