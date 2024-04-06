@extends('layouts.app')

@section('style')
@endsection

@section('content')

    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="cart">
                @php
                    $userId = !empty(Auth::user()) ? Auth::user()->id : '';
                    if ($userId != '') {
                        $cart = Cart::session($userId);
                    }
                @endphp

                <div class="container">
                    @if (!empty(Cart::getContent()->count()))
                        <div class="row">
                            <div class="col-lg-9">
                                <form action="{{ url('cart/update') }}" method="post">
                                    {{ csrf_field() }}
                                    <table class="table table-cart table-mobile">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @endphp
                                            @foreach (Cart::getContent() as $key => $value)
                                                @php
                                                    $product = App\Models\ProductModel::getSingle($value->id);

                                                @endphp
                                                @if (!empty($product))
                                                    @php
                                                        $image = App\Models\ProductModel::getImageSingle($value->id);
                                                        $size = App\Models\ProductModel::getSizeName(
                                                            $value->attributes->size_id,
                                                        );
                                                        $color = App\Models\ProductModel::getColorName(
                                                            $value->attributes->color_id,
                                                        );
                                                    @endphp
                                                    <tr>
                                                        <td class="product-col">
                                                            <div class="product">
                                                                <figure class="product-media">
                                                                    <a href="{{ url($product->slug) }}">
                                                                        <img src="{{ url($image->getImageUrl()) }}"
                                                                            alt="Product image">
                                                                    </a>
                                                                </figure>

                                                                <h3 class="product-title">
                                                                    <a
                                                                        href="{{ url($product->slug) }}">{{ $product->title }}</a>
                                                                    @if (!empty($size))
                                                                        <p>Size: {{ $size->name }}</p>
                                                                    @endif
                                                                    @if (!empty($color))
                                                                        <p>Color: {{ $color->name }}</p>
                                                                    @endif
                                                                </h3>

                                                            </div>
                                                        </td>
                                                        <td class="price-col">x ${{ number_format($value->price, 2) }}</td>
                                                        <td class="quantity-col">
                                                            <div class="cart-product-quantity">
                                                                <input type="number" class="form-control"
                                                                    value="{{ $value->quantity }}"
                                                                    name="cart[{{ $key }}][qty]" min="1"
                                                                    max="100" step="1" data-decimals="0"
                                                                    required>
                                                            </div>
                                                            <input type="hidden" class="form-control"
                                                                value="{{ $value->id }}"
                                                                name="cart[{{ $key }}][id]">

                                                        </td>
                                                        <td class="total-col">
                                                            ${{ number_format($value->price * $value->quantity, 2) }}</td>
                                                        <td class="remove-col"><a
                                                                href="{{ url('cart/remove/' . $value->id) }}"
                                                                class="btn-remove"><i class="icon-close"></i></button></td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                        </tbody>
                                    </table>

                                    <div class="cart-bottom">


                                        <button type="submit" href="#" class="btn btn-outline-dark-2"><span>UPDATE
                                                CART</span><i class="icon-refresh"></i></button>
                                    </div>
                                </form>
                            </div>
                            <aside class="col-lg-3">
                                <div class="summary summary-cart">
                                    <h3 class="summary-title">Cart Total</h3>
                                    <table class="table table-summary">
                                        <tbody>
                                            <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td>${{ number_format(Cart::getSubTotal(), 2) }}</td>
                                            </tr>
                                            <tr class="summary-shipping">
                                                <td>Shipping:</td>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="free-shipping" name="shipping"
                                                            class="custom-control-input" checked>
                                                        <label class="custom-control-label" for="free-shipping">Free
                                                            Shipping</label>
                                                    </div>
                                                </td>
                                                <td>$0.00</td>
                                            </tr>

                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td>${{ number_format(Cart::getSubTotal(), 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ url('checkout') }}"
                                        class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                </div>

                                <a href="{{ url('/') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE
                                        SHOPPING</span><i class="icon-refresh"></i></a>
                            </aside>
                        </div>
                    @else
                        <div class="page-content">
                            @include('admin.layouts._message')
                            <div class="row">
                                <div class="col-lg-12 text-center mt-5">
                                    <div class="cart-empty alert alert-info">
                                        <p>Cart is empty!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>



@endsection

@section('scripts')
@endsection
