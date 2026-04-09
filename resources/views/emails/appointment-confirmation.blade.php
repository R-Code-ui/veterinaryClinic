<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background: #4CAF50; color: white; padding: 10px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Appointment Confirmation</h2>
        </div>
        <div class="content">
            <p>Dear {{ $appointment->pet->owner->name }},</p>
            <p>Your appointment has been successfully scheduled. Details are as follows:</p>

            <table>
                <tr><th>Pet Name:</th><td>{{ $appointment->pet->name }}</td></tr>
                <tr><th>Species:</th><td>{{ $appointment->pet->species }}</td></tr>
                <tr><th>Veterinarian:</th><td>Dr. {{ $appointment->vet->name }}</td></tr>
                <tr><th>Date & Time:</th><td>{{ $appointment->appointment_date->format('F d, Y h:i A') }}</td></tr>
                <tr><th>Reason:</th><td>{{ $appointment->reason }}</td></tr>
                <tr><th>Status:</th><td>{{ ucfirst($appointment->status) }}</td></tr>
            </table>

            <p>Please arrive 10 minutes before your scheduled time. If you need to reschedule, please contact us at least 24 hours in advance.</p>
            <p>Thank you for choosing our Veterinary Clinic.</p>
            <p>Best regards,<br>Veterinary Clinic Team</p>
        </div>
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
