<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="header-dropdown">
                    <a href="#">Usd</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">Usd</a></li>
                        </ul>
                    </div>
                </div>

                <div class="header-dropdown">
                    <a href="#">Eng</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">English</a></li>
                        </ul>
                    </div>
                </div>
                               
            </div>

            <div class="header-right">
                <ul class="top-menu">
                    <li style="display: flex">
                        <a href="#" style="display: block">{{ !empty(Auth::user()) ? 'Hello ' . Auth::user()->name : 'Links' }}</a>
                        <ul class="ml-5">
                            {{-- <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li> --}}
                            
                            {{-- <li><a href="{{ url('about') }}">About Us</a></li>
                            <li><a href="{{ url('contact') }}">Contact Us</a></li> --}}
                            
                            @if (!empty(Auth::check()))
                            <li><a href="{{ url('wishlist') }}"><i class="icon-heart-o"></i>My Wishlist
                                <span>(3)</span></a></li>
                            <li><a href="{{ url('my-account') }}"><i class="icon-user"></i>My Account</a></li>
                            <li><a href="{{ url('logout') }}"><i class="icon-unlock"></i>Logout</a></li>
                            
                            @else
                            <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>
                            @endif
                            

                            
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{ url('') }}" class="logo" style="min-height: 0">
                    <img src="{{ url('assets/images/logo.png') }}" alt="" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container active">
                            <a href="{{ url('') }}">Home</a>

                        </li>
                        <li>
                            <a href="javascript:;" class="sf-with-ul">Shop</a>

                            <div class="megamenu megamenu-md">
                                <div class="row no-gutters">
                                    <div class="col-md-12">
                                        <div class="menu-col">
                                            <div class="row">
                                                @php
                                                    $getCategoryHeader = App\Models\CategoryModel::getRecordMenu();
                                                @endphp
                                                @foreach ($getCategoryHeader as $value_category_header)
                                                    @if (!empty($value_category_header->getSubCategory->count()))
                                                        <div class="col-md-4 mb-2">
                                                            <div class="menu-title"><a
                                                                    href="{{ url($value_category_header->slug) }}">{{ $value_category_header->name }}</a>
                                                            </div>
                                                            <ul>
                                                                @foreach ($value_category_header->getSubCategory as $value_subcategory_header)
                                                                    <li><a
                                                                            href="{{ url($value_category_header->slug . '/' . $value_subcategory_header->slug) }}">{{ $value_subcategory_header->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>


                    </ul>
                </nav>
            </div>

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i
                            class="icon-search"></i></a>
                    <form action="{{ url('search') }}" method="get">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q"
                                placeholder="Search in..."
                                value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}" required>
                        </div>
                    </form>
                </div>

                <div class="dropdown cart-dropdown">
                    {{-- {{ $cart }} --}}
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        @php
                            $userId = !empty(Auth::user()) ? Auth::user()->id : '';
                            if ($userId != '') {
                            $cart = Cart::session($userId);
                                
                            }
                        @endphp
                        <span class="cart-count"> 
                            {{ Cart::getContent()->count() }}
                        </span>
                    </a>
                    @if (!empty(Cart::getContent()->count()))
                    <div class="dropdown-menu dropdown-menu-right">
                        
                            <div class="dropdown-cart-products">
                                @foreach (Cart::getContent() as $value)
                                    @php
                                        $product = App\Models\ProductModel::getSingle($value->id);
                                        $size = App\Models\ProductModel::getSizeName($value->attributes->size_id);
                                        $color = App\Models\ProductModel::getColorName($value->attributes->color_id);
                                    @endphp
                                    @if (!empty($product))
                                        @php
                                        $image = App\Models\ProductModel::getImageSingle($value->id);
                                        @endphp    

                                    <div class="product" data-product-id="{{ $value->id }}">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">

                                                <a href="{{ url($product->slug) }}">{{ $product->title }} $</a>
                                                @if(!empty($size))
                                                <p>Size: {{ $size->name }}</p>
                                                @endif
                                                @if(!empty($color))
                                                <p>Color: {{ $color->name }}</p>
                                                @endif
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">{{ $value->quantity }}</span>
                                                x ${{ number_format($value->price, 2) }}
                                            </span>
                                        </div>

                                        <figure class="product-image-container">
                                            <a href="{{ url($product->slug) }}" class="product-image">
                                                <img src="{{ url($image->getImageUrl()) }}" alt="product">
                                            </a>
                                        </figure>

                                        <a href="{{ url('cart/remove/'.$value->id) }}" class="btn-remove" 
                                            title="Remove Product"><i class="icon-close"></i></a>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        
                            
                        <div class="dropdown-cart-total">
                            <span>Total</span>

                            <span class="cart-total-price">${{ number_format(Cart::getSubTotal(), 2) }}</span>
                        </div>

                        <div class="dropdown-cart-action">
                            <a href="{{ url('cart') }}" class="btn btn-primary">View Cart</a>
                            <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i
                                    class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
<script src="{{ url('assets/js/jquery.min.js') }}"></script>

