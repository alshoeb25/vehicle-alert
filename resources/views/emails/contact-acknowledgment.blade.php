<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>We Received Your Message</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #fecc00; padding: 30px; border-radius: 5px 5px 0 0; text-align: center; }
        .header h2 { margin: 0; color: #1a1a1a; font-size: 24px; }
        .content { background-color: #fff; padding: 30px; border: 1px solid #ddd; border-radius: 0 0 5px 5px; }
        .thank-you { font-size: 16px; margin-bottom: 20px; }
        .details-box { background-color: #f9f9f9; padding: 15px; border-left: 4px solid #fecc00; margin: 20px 0; }
        .detail-item { margin: 10px 0; }
        .detail-label { font-weight: bold; color: #fecc00; }
        .contact-info { background-color: #f0f0f0; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .button { display: inline-block; background-color: #fecc00; color: #1a1a1a; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; font-weight: bold; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Thank You for Contacting Us!</h2>
        </div>
        
        <div class="content">
            <p class="thank-you">
                Hi <strong>{{ $contactData['name'] }}</strong>,
            </p>
            
            <p>
                We have successfully received your message and appreciate you taking the time to reach out to us. 
                We will review your inquiry and get back to you as soon as possible, typically within 24 working hours.
            </p>
            
            <div class="details-box">
                <p style="margin-top: 0; color: #666;">Here's a summary of what we received:</p>
                
                <div class="detail-item">
                    <span class="detail-label">Reference ID:</span> #{{ $contactData['id'] }}
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Your Email:</span> {{ $contactData['email'] }}
                </div>
                
                @if($contactData['phone'])
                <div class="detail-item">
                    <span class="detail-label">Your Phone:</span> {{ $contactData['phone'] }}
                </div>
                @endif
            </div>
            
            <p>
                In the meantime, feel free to explore our website or reach out to us directly:
            </p>
            
            <div class="contact-info">
                <p style="margin: 0;">
                    <strong>📧 Email:</strong> <a href="mailto:wecare@inferlogics.com">wecare@inferlogics.com</a><br>
                    <strong>📞 Phone:</strong> +123 456 7890<br>
                    <strong>📍 Location:</strong> Nagpur, Maharashtra State
                </p>
            </div>
            
            <p>
                Thank you for choosing RESPO QR Codes. We look forward to assisting you!
            </p>
            
            <div class="footer">
                <p>
                    This is an automated acknowledgment email. Please do not reply to this email.<br>
                    If you did not submit this contact form, please disregard this email.
                </p>
                <p style="margin: 0;">
                    <strong>RESPO QR Codes</strong><br>
                    Nagpur, Maharashtra State
                </p>
            </div>
        </div>
    </div>
</body>
</html>
