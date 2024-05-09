@extends('layouts.app')

@section('style')
    <style type="text/css">
        .form-group {
            margin-bottom: 5px;
        }

        label {
            font-weight: bold;
        }

        .table td {
            padding: 0.25rem;
            margin-right: 1rem;

        }

        .table th {
            text-align: center;
            padding: 1rem;
        }
    </style>
@endSection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('../assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Order Details</h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        @include('user._sidebar')

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                @include('admin.layouts._message')
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        {{-- Order Back button floating right --}}
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ url('user/orders') }}" class="btn btn-outline-primary">Back</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>ID : <span class="font-weight-normal">{{ $getRecord->id }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Transaction ID : <span
                                                        class="font-weight-normal">{{ $getRecord->transaction_id }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Name : <span class="font-weight-normal">{{ $getRecord->first_name }}
                                                        {{ $getRecord->last_name }}</span> </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Company Name : <span
                                                        class="font-weight-normal">{{ $getRecord->company_name }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Address : <span
                                                        class="font-weight-normal">{{ $getRecord->address_1 }}
                                                        {{ $getRecord->address_2 }}</span> </label>
                                            </div>
                                            <div class="form-group">
                                                <label>City : <span class="font-weight-normal">{{ $getRecord->city }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>State : <span
                                                        class="font-weight-normal">{{ $getRecord->state }}</span> </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Country : <span
                                                        class="font-weight-normal">{{ $getRecord->country }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Zip Code : <span
                                                        class="font-weight-normal">{{ $getRecord->zip_code }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone : <span
                                                        class="font-weight-normal">{{ $getRecord->phone }}</span> </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Email : <span class="font-weight-normal">{{ $getRecord->email }}
                                                    </span></label>
                                            </div>
                                            <div class="form-group">
                                                <label>Discount Code : <span
                                                        class="font-weight-normal">{{ strtoupper($getRecord->discount_code) }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Shipping Method : <span
                                                        class="font-weight-normal">{{ strtoupper($getRecord->getShipping->name) }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Shipping Amount : <span
                                                        class="font-weight-normal">{{ number_format($getRecord->shipping_amount, 2) }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Total Amount : <span
                                                        class="font-weight-normal">{{ number_format($getRecord->total_amount, 2) }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Payment Method : <span
                                                        class="font-weight-normal">{{ strtoupper($getRecord->payment) }}</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Status : <span class="font-weight-normal">
                                                        @if ($getRecord->status == 0)
                                                            Pending
                                                        @elseif($getRecord->status == 1)
                                                            Processing
                                                        @elseif($getRecord->status == 2)
                                                            Shipped
                                                        @elseif($getRecord->status == 3)
                                                            Delivered
                                                        @elseif($getRecord->status == 4)
                                                            Canceled
                                                        @endif
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Created Date : <span
                                                        class="font-weight-normal">{{ date('d-m-Y', strtotime($getRecord->created_at)) }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <h3 class="card-title px-3">Product Detail</h3>

                                        <div class="card-body mt-1">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead class="thead-dark ">
                                                        <tr class="text-nowrap text-center">
                                                            <th>Image</th>
                                                            <th>Product Name</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            
                                                            <th>Total Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($getRecord->getItem as $key => $value)
                                                            @php
                                                                $getProductImage = $value->getProduct->getImageSingle(
                                                                    $value->getProduct->id,
                                                                );

                                                            @endphp
                                                            <tr class="text-center">
                                                                <td class="m-3"><img
                                                                        src="{{ $getProductImage->getImageUrl() }}"
                                                                        width="150px" class="img-thumbnail" />
                                                                </td>
                                                                <td class="text-nowrap text-left p-3">
                                                                    <a target="_blank"
                                                                        href="{{ url($value->getProduct->slug) }}">
                                                                        {{ $value->getProduct->title }}
                                                                    </a>
                                                                    <br>
                                                                    <b>Size:</b>
                                                                    {{ !empty($value->getSize) ? $value->getSize->name : 'N/A' }}
                                                                    <br>
                                                                    <b>Color:</b> {{ $value->getColor->name }}
                                                                    <br>
                                                                    @if ($getRecord->status == 3)
                                                                        @php
                                                                            $getReview = $value->getReview(
                                                                                $value->getProduct->id,
                                                                                $getRecord->id,
                                                                            );
                                                                        @endphp
                                                                        @if (!empty($getReview))
                                                                            <b>Stars:</b> {{ $getReview->rating }} <br>
                                                                            <b>Review:</b> {{ $getReview->review }}
                                                                        @else
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-sm MakeReview"
                                                                                id={{ $value->getProduct->id }}
                                                                                data-order="{{ $getRecord->id }}">
                                                                                Make Review
                                                                            </button>
                                                                        @endif
                                                                    @endif
                                                                </td>

                                                                <td>{{ $value->quantity }}</td>
                                                                <td>{{ number_format($value->product_price, 2) }}</td>
                                                                
                                                                <td>{{ number_format($value->total, 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="makeReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('user/make-review') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="order_id" id="order_id" required>
                        <input type="hidden" name="product_id" id="product_id" required>
                        <div class="row justify-content-center px-3 mt-3">
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <label for="">How many stars?</label>
                                    <select class="form-control" name="rating" id="rating" required>
                                        <option value="">Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center px-3 ">
                            <div class="col-md-12 text-center ">
                                <div class="form-group">
                                    <label for="">Review</label>
                                    <textarea class="form-control" name="review" id="review" cols="30" rows="5"
                                        placeholder="Enter your comment..." required></textarea>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endSection


@section('scripts')
    <script type="text/javascript">
        $('body').delegate('.MakeReview', 'click', function(e) {
            e.preventDefault();
            var product_id = $(this).attr('id');
            var order_id = $(this).attr('data-order');
            $('#order_id').val(order_id);
            $('#product_id').val(product_id);

            $('#makeReviewModal').modal('show');

        })
    </script>
@endsection
