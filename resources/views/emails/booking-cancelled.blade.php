<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consultation Cancelled — Ganesha Astro Consultancy</title>
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
                            <h1 style="font-size: 24px; margin: 0; color: #F7F0E3; font-weight: bold;">Booking Cancelled</h1>
                            <p style="font-size: 13px; color: #D8C6A8; margin: 6px 0 0 0;">Vedic Astrologer Tamal Chakraborty</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px; color: #F7F0E3; font-size: 14px; line-height: 1.6;">
                            <p style="margin-top: 0;">Namaste <strong>{{ $appointment->name }}</strong>,</p>
                            <p>This email is to inform you that your consultation booking reference <strong>{{ $appointment->booking_reference }}</strong> has been cancelled.</p>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #EDE3D4; border-radius: 12px; border: 1px solid #D8C6A8; margin: 20px 0; color: #541F1D; font-size: 13px; padding: 16px;">
                                <tr>
                                    <td>
                                        <strong>Booking Status:</strong> Cancelled<br>
                                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->preferred_date)->format('d M Y') }}<br>
                                        <strong>Slot:</strong> {{ $appointment->preferred_time }}<br>
                                        <strong>Payment Status:</strong> {{ $appointment->payment_status }}
                                    </td>
                                </tr>
                            </table>

                            <p>If you have any questions or wish to book a new appointment slot, please visit our website or contact our support team below.</p>
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
