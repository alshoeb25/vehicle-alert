<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Your Password</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2>Password Reset Request</h2>
        
        <p>Hello {{ $name }},</p>
        
        <p>We received a request to reset your password. Click the button below to set a new password:</p>
        
        <div style="margin: 30px 0;">
            <a href="{{ $resetUrl }}" style="background-color: #28a745; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                Reset Password
            </a>
        </div>
        
        <p>Or copy and paste this link in your browser:</p>
        <p><small>{{ $resetUrl }}</small></p>
        
        <p>This reset link will expire in 24 hours.</p>
        
        <p>If you did not request a password reset, please ignore this email and your password will remain unchanged.</p>
        
        <hr style="margin: 30px 0;">
        <p style="color: #666; font-size: 12px;">
            This is an automated email. Please do not reply to this email.
        </p>
    </div>
</body>
</html>
