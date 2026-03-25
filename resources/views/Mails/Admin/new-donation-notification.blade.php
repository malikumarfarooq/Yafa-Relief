<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Donation Notification</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .donation-details { background-color: #f8f9fa; padding: 15px; margin: 20px 0; }
        .footer { text-align: center; font-size: 12px; color: #666; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Donation Received</h1>
            <p>A new donation has been successfully processed on your platform.</p>
        </div>

        <div class="content">
            <div class="donation-details">
                <h3>Donation Details:</h3>
                <p><strong>Donation Number:</strong> {{ $donation->donation_number }}</p>
                <p><strong>Donor Name:</strong> {{ $donation->first_name }} {{ $donation->last_name }}</p>
                <p><strong>Donor Email:</strong> {{ $donation->email }}</p>
                <p><strong>Amount:</strong> ${{ number_format($donation->total_amount, 2) }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst($donation->payment_provider) }}</p>
                <p><strong>Transaction ID:</strong> {{ $donation->transaction_id }}</p>
                <p><strong>Date:</strong> {{ $donation->created_at->format('M d, Y H:i') }}</p>
            </div>

            @if($donation->items && $donation->items->count() > 0)
            <div class="donation-details">
                <h3>Donation Items:</h3>
                @foreach($donation->items as $item)
                <p><strong>{{ $item->program->title ?? 'Program' }}:</strong> ${{ number_format($item->amount, 2) }}</p>
                @endforeach
            </div>
            @endif

            <p>Please log in to your admin panel to view more details and manage this donation.</p>
        </div>

        <div class="footer">
            <p>This is an automated notification from {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>