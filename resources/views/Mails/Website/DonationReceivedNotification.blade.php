<x-mail::message>
# Thank you, {{ $donation->first_name }}!

Your generous donation has been received. Because of your support, we can continue our mission to help families facing hunger, lack of access to education, and challenges in meeting their daily living needs.

**Donation Details:**
- **Donation Number:** {{ $donation->donation_number }}
- **Total Amount:** ${{ number_format($donation->total_amount, 2) }}
- **Date:** {{ $donation->created_at->format('M d, Y') }}

<x-mail::table>
| Program | - | Frequency | - | Amount |
| :--- | :--- | :--- | :--- | :--- |
@foreach($donation->items as $item)
| {{ $item->title }} | - | {{ ucfirst($item->frequency) }} | - | ${{ number_format($item->amount, 2) }} |
@endforeach
</x-mail::table>

If you have any questions regarding this receipt, please contact our support team.

Thanks,<br>
The {{ config('app.name') }} Team
</x-mail::message>