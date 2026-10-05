<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Confirmed — Ganesha Astro Consultancy</title>
</head>
<body style="margin: 0; padding: 0; background-color: #F7F0E3; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #29211F;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #F7F0E3; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; width: 100%; background-color: #351211; border-radius: 16px; border: 1px solid #C49A45; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="padding: 28px 30px; text-align: center; border-b: 1px solid #C49A45; background-color: #541F1D;">
                            <span style="font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 3px; color: #C49A45; display: block; margin-bottom: 6px;">GANESHA ASTRO CONSULTANCY</span>
                            <h1 style="font-size: 24px; margin: 0; color: #F7F0E3; font-weight: bold;">Booking & Payment Confirmed</h1>
                            <p style="font-size: 13px; color: #D8C6A8; margin: 6px 0 0 0;">Vedic Astrologer Tamal Chakraborty</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px; color: #F7F0E3; font-size: 14px; line-height: 1.6;">
                            <p style="margin-top: 0;">Namaste <strong>{{ $appointment->name }}</strong>,</p>
                            <p>Thank you for choosing Ganesha Astro Consultancy. Your payment has been successfully verified, and your 1-on-1 audio consultation is officially confirmed.</p>

                            <!-- Details Table -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #F7F0E3; border-radius: 12px; border: 1px solid #D8C6A8; margin: 20px 0; color: #29211F; font-size: 13px;">
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #81766D; width: 40%;">Booking Reference:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #541F1D; font-family: monospace;">{{ $appointment->booking_reference }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #81766D;">Consultation Type:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; color: #29211F;">{{ $appointment->consultation_type }} Consultation</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #81766D;">Consultation Mode:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; color: #29211F;">Audio Consultation (1-on-1 Call)</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #81766D;">Date:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; color: #541F1D; font-weight: bold;">{{ \Carbon\Carbon::parse($appointment->preferred_date)->format('l, d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #81766D;">Time Slot:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; color: #541F1D; font-weight: bold;">{{ $appointment->preferred_time }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; font-weight: bold; color: #81766D;">Amount Paid:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8C6A8; color: #541F1D; font-weight: bold;">₹{{ number_format($appointment->amount, 2) }} INR</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; font-weight: bold; color: #81766D;">Payment Reference:</td>
                                    <td style="padding: 12px 16px; color: #29211F; font-family: monospace;">{{ $appointment->payment_reference ?? 'VERIFIED' }}</td>
                                </tr>
                            </table>

                            <!-- Important Instructions -->
                            <div style="background-color: #EDE3D4; border-radius: 12px; border: 1px solid #D8C6A8; padding: 16px; margin: 20px 0; color: #541F1D; font-size: 13px;">
                                <strong style="display: block; margin-bottom: 8px; color: #541F1D;">📞 Consultation Instructions:</strong>
                                <ul style="margin: 0; padding-left: 20px; line-height: 1.5;">
                                    <li>Our desk team will initiate an Audio Call to your mobile number (<strong>{{ $appointment->phone }}</strong>) at your scheduled slot time.</li>
                                    <li>Please keep your birth details and key queries ready for discussion.</li>
                                </ul>
                            </div>

                            <p style="margin-bottom: 0;">If you need to contact desk support, please reach out to us:</p>
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
