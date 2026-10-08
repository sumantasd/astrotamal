<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consultation Rescheduled — Ganesha Astro Consultancy</title>
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
                            <h1 style="font-size: 24px; margin: 0; color: #F7F0E3; font-weight: bold;">Consultation Slot Updated</h1>
                            <p style="font-size: 13px; color: #D8CDBD; margin: 6px 0 0 0;">Vedic Astrologer Tamal Chakraborty</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px; color: #F7F0E3; font-size: 14px; line-height: 1.6;">
                            <p style="margin-top: 0;">Namaste <strong>{{ $appointment->name }}</strong>,</p>
                            <p>Please note that your consultation booking <strong>{{ $appointment->booking_reference }}</strong> has been rescheduled.</p>

                            <!-- Comparison Box -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 20px 0; font-size: 13px;">
                                <tr>
                                    <td width="48%" style="background-color: #F7F0E3; border-radius: 12px; border: 1px solid #D8CDBD; padding: 14px; color: #66736D; vertical-align: top;">
                                        <strong style="display: block; color: #66736D; font-size: 11px; text-transform: uppercase; margin-bottom: 6px;">PREVIOUS SLOT</strong>
                                        <div style="text-decoration: line-through; color: #66736D;">Date: {{ $previousDate }}</div>
                                        <div style="text-decoration: line-through; color: #66736D;">Time: {{ $previousTime }}</div>
                                    </td>
                                    <td width="4%"></td>
                                    <td width="48%" style="background-color: #F7F0E3; border-radius: 12px; border: 2px solid #C49A45; padding: 14px; color: #0B3D2E; vertical-align: top;">
                                        <strong style="display: block; color: #C49A45; font-size: 11px; text-transform: uppercase; margin-bottom: 6px;">★ NEW CONFIRMED SLOT</strong>
                                        <div style="font-weight: bold; color: #0B3D2E;">Date: {{ \Carbon\Carbon::parse($appointment->preferred_date)->format('l, d F Y') }}</div>
                                        <div style="font-weight: bold; color: #0B3D2E;">Time: {{ $appointment->preferred_time }}</div>
                                    </td>
                                </tr>
                            </table>

                            <div style="background-color: #F7F0E3; border-radius: 12px; border: 1px solid #D8CDBD; padding: 16px; margin: 20px 0; color: #0B3D2E; font-size: 13px;">
                                <strong style="display: block; margin-bottom: 6px; color: #0B3D2E;">Note:</strong>
                                Your consultation mode remains <strong>1-on-1 Audio Call</strong>. Our desk team will call you at your updated slot time on <strong>{{ $appointment->phone }}</strong>. You can also view your updated schedule anytime by signing into your account at <a href="{{ url('/account') }}" style="color: #0B3D2E; font-weight: bold;">/account</a>.
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
