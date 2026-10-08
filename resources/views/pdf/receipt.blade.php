<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AstroTamal Consultation Receipt - {{ $appointment->booking_reference }}</title>
    <style>
        @page {
            margin: 0;
            size: a4 portrait;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #FBF8F1;
            color: #17211D;
            margin: 0;
            padding: 40px;
            font-size: 12px;
            line-height: 1.5;
        }
        .container {
            background-color: #FFFFFF;
            border: 2px solid #D8CDBD;
            border-radius: 12px;
            padding: 35px;
        }
        .header {
            border-bottom: 2px solid #C49A45;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .brand-title {
            font-size: 20px;
            font-weight: bold;
            color: #0B3D2E;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 4px 0;
        }
        .brand-subtitle {
            font-size: 11px;
            color: #66736D;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin: 0;
        }
        .status-badge {
            background-color: #0B3D2E;
            color: #FFFFFF;
            border: 1px solid #C49A45;
            padding: 6px 14px;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 20px;
            display: inline-block;
            float: right;
        }
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #0B3D2E;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid #D8CDBD;
            padding-bottom: 6px;
            margin-top: 25px;
            margin-bottom: 12px;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.data-table td {
            padding: 8px 10px;
            vertical-align: top;
        }
        table.data-table td.label {
            width: 35%;
            font-weight: bold;
            color: #0B3D2E;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
        }
        table.data-table td.value {
            width: 65%;
            color: #17211D;
        }
        .highlight-box {
            background-color: #F7F0E3;
            border: 1px solid #C49A45;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        .footer-note {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px dashed #D8CDBD;
            font-size: 10px;
            color: #66736D;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <span class="status-badge">✓ CONFIRMED & PAID</span>
        <h1 class="brand-title">GANESHA ASTRO CONSULTANCY</h1>
        <p class="brand-subtitle">Vedic Astrologer Tamal Chakraborty | Official Receipt</p>
    </div>

    <div class="section-title">Verified Payment & Booking Details</div>
    
    <table class="data-table">
        <tr>
            <td class="label">Booking Reference:</td>
            <td class="value"><strong>{{ $appointment->booking_reference }}</strong></td>
        </tr>
        <tr>
            <td class="label">Payment Transaction ID:</td>
            <td class="value">{{ $appointment->payment_reference ?? ($transaction->payment_id ?? 'N/A') }}</td>
        </tr>
        <tr>
            <td class="label">Payment Gateway / Method:</td>
            <td class="value">{{ $appointment->payment_method ?? 'Razorpay Online Payment' }}</td>
        </tr>
        <tr>
            <td class="label">Amount Paid:</td>
            <td class="value"><strong style="font-size: 14px; color: #0B3D2E;">₹{{ number_format($appointment->amount, 2) }} INR</strong></td>
        </tr>
        <tr>
            <td class="label">Payment Verified At:</td>
            <td class="value">
                @if(isset($transaction->verified_at))
                    {{ \Carbon\Carbon::parse($transaction->verified_at)->setTimezone('Asia/Kolkata')->format('d M Y, h:i A T') }}
                @else
                    {{ \Carbon\Carbon::parse($appointment->updated_at)->setTimezone('Asia/Kolkata')->format('d M Y, h:i A T') }}
                @endif
            </td>
        </tr>
    </table>

    <div class="highlight-box">
        <div style="font-size: 11px; font-weight: bold; color: #0B3D2E; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
            Scheduled Consultation Timing
        </div>
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td style="width: 50%;">
                    <span style="font-size: 10px; color: #66736D; text-transform: uppercase; display: block;">Consultation Date</span>
                    <strong style="color: #0B3D2E; font-size: 13px;">{{ \Carbon\Carbon::parse($appointment->preferred_date)->setTimezone('Asia/Kolkata')->format('l, d F Y') }}</strong>
                </td>
                <td style="width: 50%;">
                    <span style="font-size: 10px; color: #66736D; text-transform: uppercase; display: block;">Time Slot</span>
                    <strong style="color: #0B3D2E; font-size: 13px;">{{ $appointment->preferred_time }}</strong>
                </td>
            </tr>
            <tr style="margin-top: 10px;">
                <td style="padding-top: 8px;">
                    <span style="font-size: 10px; color: #66736D; text-transform: uppercase; display: block;">Consultation Type</span>
                    <strong>{{ $appointment->consultation_type }} Consultation</strong>
                </td>
                <td style="padding-top: 8px;">
                    <span style="font-size: 10px; color: #66736D; text-transform: uppercase; display: block;">Consultation Mode</span>
                    <strong>1-on-1 Audio Call</strong>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-title">Client Information</div>

    <table class="data-table">
        <tr>
            <td class="label">Full Name:</td>
            <td class="value"><strong>{{ $appointment->name }}</strong></td>
        </tr>
        <tr>
            <td class="label">Phone / WhatsApp:</td>
            <td class="value">{{ $appointment->phone }} @if($appointment->whatsapp) (WhatsApp: {{ $appointment->whatsapp }}) @endif</td>
        </tr>
        <tr>
            <td class="label">Email Address:</td>
            <td class="value">{{ $appointment->email }}</td>
        </tr>
        <tr>
            <td class="label">Date of Birth:</td>
            <td class="value">{{ $appointment->birth_date ? \Carbon\Carbon::parse($appointment->birth_date)->format('d M Y') : 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Time of Birth:</td>
            <td class="value">
                @if($appointment->birth_time)
                    {{ \Carbon\Carbon::parse($appointment->birth_time)->format('h:i A') }} ({{ $appointment->birth_time }})
                @else
                    N/A
                @endif
            </td>
        </tr>
        <tr>
            <td class="label">Place of Birth:</td>
            <td class="value">{{ $appointment->birth_place ?? 'N/A' }}</td>
        </tr>
        @if($appointment->notes)
        <tr>
            <td class="label">Client Notes / Queries:</td>
            <td class="value">{{ $appointment->notes }}</td>
        </tr>
        @endif
    </table>

    <div class="footer-note">
        <p style="margin: 0 0 4px 0; font-weight: bold; color: #0B3D2E;">Confidentiality Guaranteed</p>
        <p style="margin: 0 0 6px 0;">All birth details and astrological consultations remain 100% strictly private & confidential.</p>
        <p style="margin: 0;">For scheduling queries or support, please call <strong>+91 8392059201</strong> or email <strong>support@astrotamal.com</strong></p>
    </div>
</div>

</body>
</html>
