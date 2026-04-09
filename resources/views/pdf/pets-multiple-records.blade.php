<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pets with >2 Medical Records</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #4CAF50; margin-bottom: 20px; }
        h1 { color: #4CAF50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { text-align: center; font-size: 12px; margin-top: 30px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Veterinary Clinic</h1>
        <p>Pets with More Than 2 Medical Records</p>
        <p>Generated on {{ now()->format('F d, Y') }}</p>
    </div>

    @if(count($pets) > 0)
        <table>
            <thead>
                <tr><th>Pet Name</th><th>Species</th><th>Owner</th><th>Medical Records Count</th></tr>
            </thead>
            <tbody>
                @foreach($pets as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->species }}</td>
                    <td>{{ $pet->owner->name }}</td>
                    <td style="text-align: center">{{ $pet->medical_records_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No pets have more than 2 medical records.</p>
    @endif

    <div class="footer">
        <p>Veterinary Clinic Management System</p>
    </div>
</body>
</html>
