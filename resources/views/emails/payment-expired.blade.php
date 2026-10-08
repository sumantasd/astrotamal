<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Session Expired — Ganesha Astro Consultancy</title>
</head>
<body style="margin: 0; padding: 0; background-color: #FBF8F1; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #17211D;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #FBF8F1; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; width: 100%; background-color: #06281F; border-radius: 16px; border: 1px solid #C49A45; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="padding: 28px 30px; text-align: center; border-bottom: 1px solid #C49A45; background-color: #0B3D2E;">
                            <span style="font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 3px; color: #E67E22; display: block; margin-bottom: 6px;">SESSION EXPIRED</span>
                            <h1 style="font-size: 24px; margin: 0; color: #F7F0E3; font-weight: bold;">Booking Session Expired</h1>
                            <p style="font-size: 13px; color: #D8CDBD; margin: 6px 0 0 0;">Ganesha Astro Consultancy</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px; color: #F7F0E3; font-size: 14px; line-height: 1.6;">
                            <p style="margin-top: 0;">Namaste <strong>{{ $appointment->name }}</strong>,</p>
                            <p>The 15-minute payment reservation window for your consultation booking has expired, and your <strong>booking is NOT confirmed</strong>.</p>
                            <p>The reserved time slot has been released back into the booking calendar so that other clients can reserve it.</p>

                            <!-- Details Table -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #F7F0E3; border-radius: 12px; border: 1px solid #D8CDBD; margin: 20px 0; color: #17211D; font-size: 13px;">
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8CDBD; font-weight: bold; color: #66736D; width: 40%;">Booking Reference:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8CDBD; font-weight: bold; color: #0B3D2E; font-family: monospace;">{{ $appointment->booking_reference }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8CDBD; font-weight: bold; color: #66736D;">Payment Status:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8CDBD; color: #E67E22; font-weight: bold;">Expired</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; font-weight: bold; color: #66736D;">Slot Status:</td>
                                    <td style="padding: 12px 16px; color: #0B3D2E; font-weight: bold;">Released</td>
                                </tr>
                            </table>

                            <!-- Action Box -->
                            <div style="background-color: #F7F0E3; border-radius: 12px; border: 1px solid #D8CDBD; padding: 20px; margin: 24px 0; text-align: center; color: #0B3D2E;">
                                <p style="margin: 0 0 14px 0; font-size: 14px; font-weight: bold;">You can create a new booking at any time</p>
                                <a href="{{ url('/book-consultation') }}" style="display: inline-block; background-color: #0B3D2E; color: #FFFFFF; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: bold; font-size: 14px; border: 1px solid #0B3D2E;">Create a New Booking</a>
                            </div>

                            <p style="margin-bottom: 0;">If you need assistance with scheduling, feel free to contact our desk support.</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 24px 30px; background-color: #06281F; border-top: 1px solid #C49A45; text-align: center; color: #D8CDBD; font-size: 12px; line-height: 1.6;">
                            <strong style="color: #C49A45; display: block; margin-bottom: 4px;">GANESHA ASTRO CONSULTANCY</strong>
                            <span>Phone / WhatsApp: <a href="tel:8392059201" style="color: #F7F0E3; text-decoration: underline;">8392059201</a></span> &bull; 
                            <span>Email: <a href="mailto:ganesha4astro@gmail.com" style="color: #F7F0E3; text-decoration: underline;">ganesha4astro@gmail.com</a></span>
                            <div style="margin-top: 12px; font-size: 11px; color: #66736D;">
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
