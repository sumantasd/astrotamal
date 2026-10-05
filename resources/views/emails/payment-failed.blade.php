<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Failed — Ganesha Astro Consultancy</title>
</head>
<body style="margin: 0; padding: 0; background-color: #F7F0E3; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #29211F;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #F7F0E3; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; width: 100%; background-color: #351211; border-radius: 16px; border: 1px solid #C49A45; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="padding: 28px 30px; text-align: center; border-bottom: 1px solid #C49A45; background-color: #541F1D;">
                            <span style="font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 3px; color: #E74C3C; display: block; margin-bottom: 6px;">PAYMENT FAILED</span>
                            <h1 style="font-size: 24px; margin: 0; color: #F7F0E3; font-weight: bold;">Booking Not Confirmed</h1>
                            <p style="font-size: 13px; color: #D8C6A8; margin: 6px 0 0 0;">Ganesha Astro Consultancy</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px; color: #F7F0E3; font-size: 14px; line-height: 1.6;">
                            <p style="margin-top: 0;">Namaste <strong>{{ $appointment->name }}</strong>,</p>
                            <p>We were unable to process your payment for your consultation request. Please note that <strong>your booking is NOT confirmed</strong>.</p>

                            <!-- Details Table -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #F7F0E3; border-radius: 12px; border: 1px solid #D8C6A8; margin: 20px 0; color: #29211F; font-size: 13px;">
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #81766D; width: 40%;">Booking Reference:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #541F1D; font-family: monospace;">{{ $appointment->booking_reference }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #81766D;">Amount:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; color: #541F1D; font-weight: bold;">₹{{ number_format($appointment->amount, 2) }} INR</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #81766D;">Payment Status:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; color: #E74C3C; font-weight: bold;">Failed</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; font-weight: bold; color: #81766D;">Booking Status:</td>
                                    <td style="padding: 12px 16px; color: #E74C3C; font-weight: bold;">NOT CONFIRMED</td>
                                </tr>
                            </table>

                            <!-- Action Box -->
                            <div style="background-color: #EDE3D4; border-radius: 12px; border: 1px solid #D8C6A8; padding: 20px; margin: 24px 0; text-align: center; color: #541F1D;">
                                <p style="margin: 0 0 14px 0; font-size: 14px; font-weight: bold;">Would you like to try booking again?</p>
                                <a href="{{ url('/book-consultation') }}" style="display: inline-block; background-color: #541F1D; color: #F7F0E3; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: bold; font-size: 14px; border: 1px solid #C49A45;">Retry Payment / Re-book Consultation</a>
                            </div>

                            <p style="margin-bottom: 0;">If money was deducted from your account, it will be refunded by your bank as per Razorpay standard timelines. Contact desk support if you need assistance.</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 24px 30px; background-color: #29211F; border-top: 1px solid #C49A45; text-align: center; color: #D8C6A8; font-size: 12px; line-height: 1.6;">
                            <strong style="color: #C49A45; display: block; margin-bottom: 4px;">GANESHA ASTRO CONSULTANCY</strong>
                            <span>Phone / WhatsApp: <a href="tel:8392059201" style="color: #F7F0E3; text-decoration: underline;">8392059201</a></span> &bull; 
                            <span>Email: <a href="mailto:ganesha4astro@gmail.com" style="color: #F7F0E3; text-decoration: underline;">ganesha4astro@gmail.com</a></span>
                            <div style="margin-top: 12px; font-size: 11px; color: #81766D;">
                                &copy; {{ date('Y') }} Ganesha Astro Consultancy — Tamal Chakraborty. All rights reserved.
                            </div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
