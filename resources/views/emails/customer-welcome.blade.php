<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Ganesha Astro Consultancy</title>
</head>
<body style="margin: 0; padding: 0; background-color: #F7F0E3; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #29211F;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #F7F0E3; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; width: 100%; background-color: #351211; border-radius: 16px; border: 1px solid #C49A45; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="padding: 28px 30px; text-align: center; border-bottom: 1px solid #C49A45; background-color: #541F1D;">
                            <span style="font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 3px; color: #C49A45; display: block; margin-bottom: 6px;">GANESHA ASTRO CONSULTANCY</span>
                            <h1 style="font-size: 24px; margin: 0; color: #F7F0E3; font-weight: bold;">Welcome to Your Account</h1>
                            <p style="font-size: 13px; color: #D8C6A8; margin: 6px 0 0 0;">Vedic Astrologer Tamal Chakraborty</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px; color: #F7F0E3; font-size: 14px; line-height: 1.6;">
                            <p style="margin-top: 0;">Namaste <strong>{{ $user->name }}</strong>,</p>
                            <p>Welcome to Ganesha Astro Consultancy! Your customer account has been successfully created.</p>
                            <p>You can log in anytime to view your booking history, track upcoming consultations, and manage your account details.</p>

                            <!-- Account Action Box -->
                            <div style="background-color: #EDE3D4; border-radius: 12px; border: 1px solid #D8C6A8; padding: 20px; margin: 24px 0; text-align: center; color: #541F1D;">
                                <p style="margin: 0 0 14px 0; font-size: 14px; font-weight: bold;">Access Your Account Dashboard</p>
                                <a href="{{ url('/account') }}" style="display: inline-block; background-color: #541F1D; color: #F7F0E3; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: bold; font-size: 14px; border: 1px solid #C49A45;">Go to My Account (/account)</a>
                            </div>

                            <p style="margin-bottom: 0;">If you have any questions or need guidance, our desk team is always ready to assist you.</p>
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
