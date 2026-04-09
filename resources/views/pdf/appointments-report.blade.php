<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointments Report - {{ date('F d, Y') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #4CAF50;
            margin: 0;
        }
        .clinic-info {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }
        .report-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 30px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Veterinary Clinic</h1>
    </div>
    <div class="clinic-info">
        <p>123 Pet Street, Animal City | Phone: (555) 123-4567 | Email: clinic@vet.com</p>
    </div>

    <div class="report-title">
        Appointments Report - {{ date('F d, Y') }}
    </div>

    @if(count($appointments) > 0)
        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Pet</th>
                    <th>Owner</th>
                    <th>Veterinarian</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->appointment_date->format('h:i A') }}</td>
                    <td>{{ $appointment->pet->name }}</td>
                    <td>{{ $appointment->pet->owner->name }}</td>
                    <td>Dr. {{ $appointment->vet->name }}</td>
                    <td>{{ $appointment->reason }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center;">No appointments scheduled for today.</p>
    @endif

    <div class="footer">
        <p>Generated on {{ now()->format('F d, Y h:i A') }} | Veterinary Clinic Management System</p>
    </div>
</body>
</html>
