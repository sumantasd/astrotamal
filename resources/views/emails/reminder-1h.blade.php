<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consultation Starting Soon — Ganesha Astro Consultancy</title>
</head>
<body style="margin: 0; padding: 0; background-color: #FBF8F1; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #17211D;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #FBF8F1; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; width: 100%; background-color: #06281F; border-radius: 16px; border: 1px solid #C49A45; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="padding: 28px 30px; text-align: center; border-bottom: 1px solid #C49A45; background-color: #0B3D2E;">
                            <span style="font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 3px; color: #C49A45; display: block; margin-bottom: 6px;">GANESHA ASTRO CONSULTANCY</span>
                            <h1 style="font-size: 24px; margin: 0; color: #F7F0E3; font-weight: bold;">Reminder: Consultation in 1 Hour</h1>
                            <p style="font-size: 13px; color: #D8CDBD; margin: 6px 0 0 0;">Vedic Astrologer Tamal Chakraborty</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px; color: #F7F0E3; font-size: 14px; line-height: 1.6;">
                            <p style="margin-top: 0;">Namaste <strong>{{ $appointment->name }}</strong>,</p>
                            <p>Your 1-on-1 audio consultation with Vedic Astrologer Tamal Chakraborty is starting in <strong>1 hour</strong>.</p>

                            <!-- Details Table -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #F7F0E3; border-radius: 12px; border: 1px solid #D8CDBD; margin: 20px 0; color: #17211D; font-size: 13px;">
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8CDBD; font-weight: bold; color: #66736D; width: 40%;">Booking Reference:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8CDBD; font-weight: bold; color: #0B3D2E; font-family: monospace;">{{ $appointment->booking_reference }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8CDBD; font-weight: bold; color: #66736D;">Time Slot:</td>
                                    <td style="padding: 12px 16px; border-bottom: 1px solid #D8CDBD; color: #0B3D2E; font-weight: bold;">{{ $appointment->preferred_time }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 16px; font-weight: bold; color: #66736D;">Contact Phone:</td>
                                    <td style="padding: 12px 16px; color: #17211D; font-weight: bold;">{{ $appointment->phone }}</td>
                                </tr>
                            </table>

                            <!-- Important Note -->
                            <div style="background-color: #F7F0E3; border-radius: 12px; border: 1px solid #D8CDBD; padding: 16px; margin: 20px 0; color: #0B3D2E; font-size: 13px;">
                                <strong style="display: block; margin-bottom: 8px; color: #0B3D2E;">📞 Please get ready:</strong>
                                <ul style="margin: 0; padding-left: 20px; line-height: 1.5; color: #17211D;">
                                    <li>Our desk team will initiate the audio call to <strong>{{ $appointment->phone }}</strong> at your designated slot time.</li>
                                    <li>Please ensure your mobile signal is active and sound is unmuted.</li>
                                </ul>
                            </div>
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
