@extends('layouts.app')

@section('style')

@endsection

@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <form action="{{ route('place_order')}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name *</label>
                                        <input type="text" class="form-control" name="first_name" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Last Name *</label>
                                        <input type="text" class="form-control" name="last_name" required>
                                    </div>
                                </div>

                                <label>Company Name (Optional)</label>
                                <input type="text" class="form-control" name="company_name">

                                <label>Country *</label>
                                <input type="text" class="form-control" name="country" required>

                                <label>Street address *</label>
                                <input type="text" class="form-control" placeholder="House number and Street name" name="address_1" required>
                                <input type="text" class="form-control" placeholder="Appartments, suite, unit etc ..." name="address_2" >

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Town / City *</label>
                                        <input type="text" class="form-control"  name="city" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>State / County *</label>
                                        <input type="text" class="form-control"  name="state" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Postcode / ZIP *</label>
                                        <input type="text" class="form-control"  name="zip_code" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="tel" class="form-control"  name="phone" required>
                                    </div>
                                </div>

                                <label>Email address *</label>
                                <input type="email" class="form-control"  name="email" required>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkout-create-acc">
                                    <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                                    <label class="custom-control-label" for="checkout-diff-address">Ship to a different address?</label>
                                </div>

                                <label>Order notes (optional)</label>
                                <textarea class="form-control"  name="note" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                        </div>
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3>

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach (Cart::getContent() as $key => $value)
                                        @php
                                            $product = App\Models\ProductModel::getSingle($value->id);
                                            
                                        @endphp
                                        @if(!empty($product))
                                            @php
                                            $image = App\Models\ProductModel::getImageSingle($value->id);
                                            $size = App\Models\ProductModel::getSizeName($value->attributes->size_id);
                                            $color = App\Models\ProductModel::getColorName($value->attributes->color_id);
                                            @endphp
                                        <tr>
                                            <td><a href="{{ url($product->slug) }}">{{ $product->title }}</a></td>
                                            <td>${{ number_format($value->price * $value->quantity, 2) }}</td>
                                        </tr>
                                        @endif
                                        @endforeach

                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>${{ number_format(Cart::getSubTotal(), 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="cart-discount mw-100">
                                                    <div class="input-group">
                                                        <input id="getDiscountCode"  type="text" class="form-control  mb-0" placeholder="discount code">
                                                        <div class="input-group-append h-100">
                                                            <button  id="ApplyDiscount" type="button" class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="alert alert-danger text-left" role="alert" id="getDiscountError" style="display: none" >
                                                    <span id="getDiscountMessage"></span>
                                                </div>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <td>Discount:</td>
                                            <td>$<span id="getDiscountAmount">{{ number_format(Cart::getTotal() - Cart::getSubTotal(), 2) }}</span></td>
                                        </tr>
                                        <tr class="summary-shipping">
                                            <td>Shipping:</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        @foreach($getShipping as $shipping)
                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" 
                                                            id="free-shipping{{$shipping->id}}" 
                                                            name="shipping" 
                                                            class="custom-control-input getShippingCharge" 
                                                            data-price="{{ !empty($shipping->price) ? $shipping->price : 0 }}"
                                                            value="{{ $shipping->id }}" required>
                                                    <label class="custom-control-label" for="free-shipping{{$shipping->id}}">{{ $shipping->name }}</label>
                                                </div>
                                            </td>
                                            <td>
                                                @if($shipping->price != 0)
                                                ${{ number_format($shipping->price, 2) }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>$<span id="getPayableTotal">{{ number_format(Cart::getSubTotal(), 2) }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" id="getShippingChargeTotal" value="0">
                                <input type="hidden" id="payableTotal" value="{{ Cart::getSubTotal()}}">

                                <div class="accordion-summary" id="accordion-payment">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" 
                                                id="cash"
                                                name="payment" 
                                                class="custom-control-input" 
                                                value="cash" required>
                                        <label class="custom-control-label" for="cash">Cash on delivery</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" 
                                                id="paypal"
                                                name="payment" 
                                                class="custom-control-input" 
                                                value="paypal">
                                        <label class="custom-control-label" for="paypal">PayPal</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" 
                                                id="stripe"
                                                name="payment" 
                                                class="custom-control-input" 
                                                value="stripe">
                                        <label class="custom-control-label" for="stripe">Credit Card (Stripe)</label>
                                    </div>
                                    <img src="{{ url('assets/images/payments-summary.png') }}" alt="payments cards">
                                    
                                </div>

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script type="text/javascript">

    $('body').on('change', '.getShippingCharge', function()  {
        var price = $(this).data('price');
        var total = $('#payableTotal').val();
        var final_total = parseFloat(price) + parseFloat(total);

        
        $('#getPayableTotal').html(final_total.toFixed(2));
        $('#getShippingChargeTotal').val(price);


    });

    $('body').on('click', '#ApplyDiscount', function()  {
        var discount_code = $('#getDiscountCode').val();
        $.ajax({
            type: "POST",
            url: "{{ url('checkout/apply_discount_code') }}",
            data: {
                discount_code: discount_code,
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {
                // Get discount amount
                $('#getDiscountAmount').html(data.discount_amount);

                // Get payable total including shipping
                var shipping = $('#getShippingChargeTotal').val();
                var total = parseFloat(shipping) + parseFloat(data.payable_total);
                $('#getPayableTotal').html(total.toFixed(2));

                $('#payableTotal').val(data.payable_total);
                
                // Hide error message
                $('#getDiscountMessage').html('');
                $('#getDiscountError').hide();
                if (data.status == false) 
                {
                    // Show error message for 10 seconds
                    $('#getDiscountError').show();
                    $('#getDiscountMessage').html(data.message);

                    setTimeout(function() {
                        $('#getDiscountError').hide();
                        $('#getDiscountCode').val('');
                    }, 5000);
                }
            },
            error: function(data) {
            }
        });
    });

</script>
@endsection
