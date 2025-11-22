<div
    style="max-width:600px;margin:auto;background:#ffffff;padding:20px;border-radius:10px;font-family:Arial, sans-serif;">
    <h2 style="color:#5AA526;margin-top:0;">Your Order Has Been Placed!</h2>

    <p style="margin:8px 0;">Hi {{ $order->customer_name }},</p>

    <p style="margin:8px 0;">Thank you for your order. Here are the details:</p>

    <p style="margin:6px 0;"><strong>Reference ID:</strong> {{ $order->reference_id }}</p>
    <p style="margin:6px 0;"><strong>Total Amount:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
    <p style="margin:6px 0;"><strong>Type:</strong> {{ ucfirst($order->type) }}</p>

    <h3 style="color:#5AA526;margin-top:16px;">Ordered Items:</h3>
    <ul style="padding-left:18px;margin-top:8px;">
        @foreach ($cartItems as $item)
            <li style="margin-bottom:6px;">
                <strong>{{ $item->name }}</strong> — Qty: {{ count($item->serials) }}
            </li>
        @endforeach
    </ul>

    <p style="margin:12px 0 8px 0;">We will notify you once your order is processed.</p>

    <hr style="border:none;border-top:1px solid #CCCCCC;margin:16px 0;">

    <p style="margin:6px 0 0 0;"><strong>Pickup / Contact Information:</strong></p>
    <p style="margin:4px 0 0 0;">
        2nd Flr. Vanessa Olga Building,<br>
        Malusak, Boac,<br>
        Marinduque
    </p>
    <p style="margin:4px 0 0 0;">
        Contact: (+63) 9992264818<br>
        Email: chldisty888@gmail.com
    </p>

    <p style="margin:12px 0 0 0;">Thank you!<br>CHL SmartSolutions</p>
</div>
