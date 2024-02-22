@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
@endsection

@section('content')


<main class="main">
    
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url($getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url($getProduct->getCategory->slug.'/'.$getProduct->getSubCategory->slug) }}">{{ $getProduct->getSubCategory->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $getProduct->title }}</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            
                            @php
                                $getProductImage = $getProduct->getImageSingle($getProduct->id);
                            @endphp


                            <figure class="product-main-image">
                                @if(!empty($getProductImage) && !empty($getProductImage->getImageUrl()))
                                <img 
                                    id="product-zoom" 
                                    src="{{ $getProductImage->getImageUrl() }}" 
                                    data-zoom="{{ $getProductImage->getImageUrl() }}"
                                    alt="product image"
                                >

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                                @endif
                            </figure>

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach($getProduct->getImage as $image)
                                
                                <a class="product-gallery-item" href="#" 
                                    data-image="{{ $image->getImageUrl() }}"
                                    data-zoom="{{ $image->getImageUrl() }}"
                                >
                                    <img src="{{ $image->getImageUrl() }}" alt="">
                                </a>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $getProduct->title }}</h1>

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div>
                                </div>
                                <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                            </div>

                            <div class="product-price">
                                ${{ number_format($getProduct->price,2) }}
                            </div>

                            <div class="product-content">
                                <p>{{ $getProduct->short_description}} </p>
                            </div>
                            
                            @if(!empty($getProduct->getColor->count()))
                            <div class="details-filter-row details-row-size">
                                <label>Color:</label>
                                <div class="product-nav product-nav-dots">
                                
                                @foreach($getProduct->getColor as $color)
                                    <a href="javascript:;" style="background: {{ $color->getColor->code }};"><span class="sr-only">{{ $color->getColor->name}}</span></a>
                                @endforeach
                                
                            </div>
                            </div>
                            @endif

                            @if(!empty($getProduct->getSize->count()))
                            <div class="details-filter-row details-row-size">
                                <label for="size">Size:</label>
                                <div class="select-custom">
                                    <select name="size" id="size" class="form-control">
                                        <option value="#" selected="selected">Select a size</option>
                                        @foreach( $getProduct->getSize as $size)
                                        <option 
                                            value="{{ $size->price }}">
                                                {{ $size->name }} 
                                                @if(!empty($size->price)) 
                                                    (${{ number_format($size->price,2)}}
                                                @endif)
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            </div>

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                </div>
                            </div>

                            <div class="product-details-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>

                                <div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                    {{-- <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a> --}}
                                </div>
                            </div>

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    <a href="{{ url($getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }}</a>,
                                    <a href="{{ url($getProduct->getCategory->slug.'/'.$getProduct->getSubCategory->slug) }}">{{ $getProduct->getSubCategory->name }}</a>
                                    
                                </div>

                                {{-- <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <div class="container mt-2">
                            {!! $getProduct->description !!}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <div class="container mt-2">
                            {!! $getProduct->additional_information !!}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <div class="container mt-2">
                            {!! $getProduct->shipping_returns !!}    
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                    <div class="reviews">
                        <div class="container mt-2">
                            <h3>Reviews (2)</h3>
                            <div class="review">
                                
                                </div>
                            </div>

                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">John Doe</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">5 days ago</span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>Very good</h4>

                                        <div class="review-content">
                                            <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                        </div><!-- End .review-action -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>

                @foreach($getRelatedProduct as $value)
                @php
                    $getProductImage = $value->getImageSingle($value->id);
                @endphp
                <div class="product product-7">
                    <figure class="product-media">
                        @if(!empty($getProductImage) && !empty($getProductImage->getImageUrl()))
                        <a href="{{ url($value->slug) }}">
                            <img src="{{ $getProductImage->getImageUrl()  }}" 
                                alt="{{ $value->title}}" 
                                style="height: 280px; width: 100%; object-fit:cover;"
                                class="product-image">
                        </a>
                        @endif
                        

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        </div>
                        
                    </figure>

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="{{ url($value->category_slug.'/'.$value->sub_category_slug) }}">{{ $value->sub_category_name }}</a>
                        </div>
                        <h3 class="product-title"><a href="{{ url($value->slug) }}">{{ $value->title }}
                        </a></h3>
                        <div class="product-price">
                            ${{ number_format($value->price, 2) }}
                        </div>
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 20%;"></div>
                            </div>
                            <span class="ratings-text">( 2 Reviews )</span>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ url('assets/js/jquery.elevateZoom.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ url('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // $('.product-gallery-item').click(function(event) {
        //     event.preventDefault();
        //     var imageUrl = $(this).attr('data-image');
        //     $('#product-zoom').attr('src', imageUrl);
        // });

        $('#size').change(function() {
                var newSize = $(this).val();
                var newPrice = parseFloat(newSize);
                if (!isNaN(newPrice)) {
                    $('.product-price').text('$' + newPrice.toFixed(2));
                } else {
                    $('.product-price').text('$' + parseFloat({{ $getProduct->price }}).toFixed(2));
                }
            });
        
        $('.product-nav-dots a').click(function() {
            $('.product-nav-dots a').removeClass('active');
            $(this).addClass('active');
        })

    });

</script>

@endsection
