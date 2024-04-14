@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard {{ config('app.name') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ config('app.name') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Orders</span>
                                <span class="info-box-number">
                                    {{ $getOrder->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-comment-dollar"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Today Orders</span>
                                <span class="info-box-number">{{ $getTodayOrders }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                    class="fas fa-file-invoice-dollar"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Today Sales</span>
                                <span class="info-box-number">$ {{ $getTodaySales }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Customers</span>
                                <span class="info-box-number">{{ $getCustomer->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-6">
                        @if (!empty($getRecordUser))
                        @endif
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $getRecordUser->count() }}</h3>

                                <p>Admin Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ url('admin/admin/list') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $getRecordProduct->count() }}</h3>

                                <p>Products</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-list-outline"></i>
                            </div>
                            <a href="{{ url('admin/product/list') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $getCategory->count() }}</h3>

                                <p>Category</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-list-outline"></i>
                            </div>
                            <a href="{{ url('admin/category/list') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $getSubCategory->count() }}</h3>

                                <p>SubCategory</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-list-outline"></i>
                            </div>
                            <a href="{{ url('admin/subcategory/list') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $getBrand->count() }}</h3>

                                <p>Brand</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-list-outline"></i>
                            </div>
                            <a href="{{ url('admin/brand/list') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $getColor->count() }}</h3>

                                <p>Color</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-list-outline"></i>
                            </div>
                            <a href="{{ url('admin/color/list') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Latest Orders </h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>#</th>
                                                <th>Order Number</th>
                                                <th>Name</th>
                                                <th>Company Name</th>
                                                {{-- <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Country</th>
                                                <th>Zip</th>
                                                <th>Phone</th> --}}
                                                <th>Email</th>
                                                {{-- <th>Discount Code</th>
                                                <th>Discount Amount</th>
                                                <th>Shipping Charge</th>
                                                <th>Shipping Amount</th> --}}
                                                <th>Total Amount</th>
                                                <th>Payment Type</th>
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getLatestOrder as $value)
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td>{{ $value->order_number }}</td>
                                                    <td>{{ $value->first_name }}</td>
                                                    <td>{{ $value->company_name }}</td>
                                                    {{-- <td>{{ $value->address_1 }} <br /> {{ $value->address_2 }}</td>
                                                    <td>{{ $value->city }}</td>
                                                    <td>{{ $value->state }}</td>
                                                    <td>{{ $value->country }}</td>
                                                    <td>{{ $value->zip_code }}</td>
                                                    <td>{{ $value->phone }}</td> --}}
                                                    <td>{{ $value->email }}</td>
                                                    {{-- <td>{{ strtoupper($value->discount_code) }}</td>
                                                    <td>{{ $value->discount_amount }}</td>
                                                    <td>{{ $value->shipping_name }}</td>
                                                    <td>{{ $value->shipping_amount }}</td> --}}
                                                    <td>{{ $value->total_amount }}</td>
                                                    <td>{{ $value->payment }}</td>
                                                    
                                                    <td>{{ date('m-d-Y', strtotime($value->created_at)) }}</td>
                                                    <td class="d-flex">
                                                        <a href="{{ url('admin/orders/detail/' . $value->id) }}"
                                                            class="btn btn-primary mr-2">Detail</a>
                                                    </td>
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
@endsection

@section('script')
    <script src="{{ url('public/assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
