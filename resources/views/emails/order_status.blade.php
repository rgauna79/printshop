@component('mail::message')

<p>Hello {{ $order->first_name }},</p>

<p>Your Order Status has been changed to:
@if($order->status == 0)
    <strong>Pending</strong>
@elseif($order->status == 1)
    <strong>Processing</strong>
@elseif($order->status == 2)
    <strong>Delivered</strong>
@elseif($order->status == 3)
    <strong>Completed</strong>
@elseif($order->status == 4)
    <strong>Cancelled</strong>
@endif
</p>

<h3 style="font-size: 20px; color: #333; margin-bottom: 10px;">Order Details</h3>
<ul>
    <li><strong>Order Number:</strong> {{ $order->order_number }}</li>
    <li><strong>Order Date:</strong> {{ date('m-d-Y', strtotime($order->created_at)) }}</li>
</ul>

<table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
    <thead>
        <tr>
            <th style="border-bottom: 1px solid #333; padding: 10px 0; text-align: left">Product</th>
            <th style="border-bottom: 1px solid #333; padding: 10px 0; text-align: center">Quantity</th>
            <th style="border-bottom: 1px solid #333; padding: 10px 0; text-align: left">Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->getItem as $item)
            <tr>
            <td style="border-bottom: 1px solid #ddd; padding: 10px 0">
                {{ $item->getProduct->title }}
                <br>
                Color: {{ $item->getProduct->getColorName($item->product_color_id)->name }}
                <br>
                @if(!empty($item->product_size_id))
                Size: {{ $item->getProduct->getSizeName($item->product_size_id)->name }}
                @endif
            </td>
            <td style="border-bottom: 1px solid #ddd; text-align: center; padding: 10px 0">{{ $item->quantity }}</td>
            <td style="border-bottom: 1px solid #ddd; padding: 10px 0">${{ $item->total }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" style="text-align:right;padding: 10px 15px"><strong>Sub Total:</strong></td>
            <td style="padding: 10px 0">${{ number_format(Cart::getSubTotal(),2) }}</td>
        </tr>
        @if(!empty($order->discount_code))
        <tr>
            <td colspan="2" style="text-align:right;padding: 10px 15px"><strong>Discount Code: {{ strtoupper($order->discount_code) }}</strong></td>
            <td style="padding: 10px 0">${{ $order->discount_amount }}</td>
        </tr> 
        @endif
        <tr>
            <td colspan="2" style="text-align:right;padding: 10px 15px"><strong>Shipping Method: {{ strtoupper($order->getShipping->name) }}</strong></td>
            <td style="padding: 10px 0">${{ $order->shipping_amount }}</td>
        </tr> 
        <tr>
            <td colspan="2" style="text-align:right; padding: 10px 15px"><strong>Total: </strong></td>
            <td style="padding: 10px 0">${{ $order->total_amount }}</td>
        </tr> 
    </tbody>
</table>


<p>If you have any questions, please contact us at <a href="mailto:{{ config('app.email') }}" style="color: #007bff;">{{ config('app.email') }}</a>.</p>

<p>Best regards,<br>{{ config('app.name') }}</p>

<p style="color: #888; font-size: 14px;">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
@endcomponent
