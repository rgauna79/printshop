@extends('admin.layouts.app')
@section('style')
    <style type="text/css">
        .form-group {
            margin-bottom: 5px;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Order Detail</h1>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">

                            <div class="card-body">
                                <div class="form-group">
                                    <label>ID : <span class="font-weight-normal">{{ $getRecord->id }}</span> </label>
                                </div>
                                <div class="form-group">
                                    <label>Transaction ID : <span
                                            class="font-weight-normal">{{ $getRecord->transaction_id }}</span> </label>
                                </div>
                                <div class="form-group">
                                    <label>Name : <span class="font-weight-normal">{{ $getRecord->first_name }}
                                            {{ $getRecord->last_name }}</span> </label>
                                </div>
                                <div class="form-group">
                                    <label>Company Name : <span
                                            class="font-weight-normal">{{ $getRecord->company_name }}</span> </label>
                                </div>
                                <div class="form-group">
                                    <label>Address : <span class="font-weight-normal">{{ $getRecord->address_1 }}
                                            {{ $getRecord->address_2 }}</span> </label>
                                </div>
                                <div class="form-group">
                                    <label>City : <span class="font-weight-normal">{{ $getRecord->city }}</span> </label>
                                </div>
                                <div class="form-group">
                                    <label>State : <span class="font-weight-normal">{{ $getRecord->state }}</span> </label>
                                </div>
                                <div class="form-group">
                                    <label>Country : <span class="font-weight-normal">{{ $getRecord->country }}</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Zip Code : <span class="font-weight-normal">{{ $getRecord->zip_code }}</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Phone : <span class="font-weight-normal">{{ $getRecord->phone }}</span> </label>
                                </div>
                                <div class="form-group">
                                    <label>Email : <span class="font-weight-normal">{{ $getRecord->email }} </span></label>
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
                                        </span> </label>
                                </div>
                                <div class="form-group">
                                    <label>Created Date : <span
                                            class="font-weight-normal">{{ date('d-m-Y', strtotime($getRecord->created_at)) }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product Detail</h3>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="text-nowrap">
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
                                                <tr>
                                                    <td><img src="{{ $getProductImage->getImageUrl() }}" width="50px" />
                                                    </td>
                                                    <td>
                                                        <a target="_blank" href="{{ url($value->getProduct->slug) }}">
                                                            {{ $value->getProduct->title }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $value->quantity }}</td>
                                                    <td>{{ number_format($value->product_price, 2) }}</td>
                                                    <td>{{ !empty($value->getSize) ? $value->getSize->name : 'N/A' }}</td>
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
        </section>
    </div>
@endsection

@section('script')
@endsection
