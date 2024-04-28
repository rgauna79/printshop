<div class="products mb-3">
    <div class="row justify-content-center">
        @foreach($getProduct as $value)
        @php
            $getProductImage = $value->getImageSingle($value->id);
        @endphp
       
        <div class="col-12 col-md-4 col-lg-4">
            <div class="product product-7 text-center">
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
                        @if (!empty(Auth::check()))
                                    <a href="javascript:;" data-toggle="modal"
                                        id="{{ $value->id }}"
                                        class="add_to_wishlist whislist_add{{ $value->id }} btn-product-icon btn-wishlist {{ !empty($value->checkWishList($value->id)) ? 'btn-whishlist-add' : '' }} btn-expandable" 
                                        title="Wishlist"><span>add to
                                            wishlist</span></a>
                                @else
                                    <a href="#signin-modal" data-toggle="modal"
                                        class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist"><span>add to
                                            wishlist</span></a>
                                @endif
                    </div>
                    
                </figure>

                <div class="product-body">
                    <div class="product-cat">
                        <a href="{{ url($value->category_slug.'/'.$value->sub_category_slug) }}">{{ $value->sub_category_name }}</a>
                    </div>
                    <h3 class="product-title">
                        <a href="{{ url($value->slug) }}">{{ $value->title }}
                        </a>
                    </h3>
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
        </div>
        @endforeach

    </div>
</div>


{{-- <div class="justify-content-center">
    {!! $getProduct->appends(Illuminate\Support\Facades\Request::except('page'))->
    links() !!}
</div> --}}