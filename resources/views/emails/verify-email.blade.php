<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verify Your Email</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2>Welcome {{ $name }}!</h2>
        
        <p>Thank you for registering with us. Please verify your email address by clicking the button below:</p>
        
        <div style="margin: 30px 0;">
            <a href="{{ $verificationUrl }}" style="background-color: #007bff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                Verify Email Address
            </a>
        </div>
        
        <p>Or copy and paste this link in your browser:</p>
        <p><small>{{ $verificationUrl }}</small></p>
        
        <p>This verification link will expire in 24 hours.</p>
        
        <p>If you did not register with us, please ignore this email.</p>
        
        <hr style="margin: 30px 0;">
        <p style="color: #666; font-size: 12px;">
            This is an automated email. Please do not reply to this email.
        </p>
    </div>
</body>
</html>
