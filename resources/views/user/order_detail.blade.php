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
            padding: 1rem;
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

                                <div class="row">
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
                                                            <th>Size</th>
                                                            <th>Color</th>
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
                                                                <td><img src="{{ $getProductImage->getImageUrl() }}"
                                                                        width="50px" class="px-2" />
                                                                </td>
                                                                <td>
                                                                    <a target="_blank"
                                                                        href="{{ url($value->getProduct->slug) }}">
                                                                        {{ $value->getProduct->title }}
                                                                    </a>
                                                                </td>
                                                                <td>{{ $value->quantity }}</td>
                                                                <td>{{ number_format($value->product_price, 2) }}</td>
                                                                <td>{{ !empty($value->getSize) ? $value->getSize->name : 'N/A' }}
                                                                </td>
                                                                <td>{{ $value->getColor->name }}</td>
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
@endSection


@section('scripts')
    <script></script>
@endsection
