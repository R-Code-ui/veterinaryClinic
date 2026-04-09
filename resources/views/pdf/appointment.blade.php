<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #4CAF50; margin: 0; }
        .clinic-info { text-align: center; font-size: 14px; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        .footer { text-align: center; font-size: 12px; margin-top: 30px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Veterinary Clinic</h1>
    </div>
    <div class="clinic-info">
        <p>123 Pet Street, Animal City | Phone: (555) 123-4567 | Email: clinic@vet.com</p>
    </div>

    <h3>Appointment Receipt</h3>
    <table>
        <tr><th>Pet Name</th><td>{{ $appointment->pet->name }}</td></tr>
        <tr><th>Owner Name</th><td>{{ $appointment->pet->owner->name }}</td></tr>
        <tr><th>Veterinarian</th><td>Dr. {{ $appointment->vet->name }}</td></tr>
        <tr><th>Date & Time</th><td>{{ $appointment->appointment_date->format('F d, Y h:i A') }}</td></tr>
        <tr><th>Reason</th><td>{{ $appointment->reason }}</td></tr>
        <tr><th>Status</th><td>{{ ucfirst($appointment->status) }}</td></tr>
    </table>

    <div class="footer">
        <p>Thank you for choosing our clinic. Please arrive 10 minutes early.</p>
        <p>This is a system-generated receipt. No signature required.</p>
    </div>
</body>
</html>
