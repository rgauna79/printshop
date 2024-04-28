@extends('layouts.app')

@section('style')
    <style type="text/css">
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
                <h1 class="page-title">Orders</h1>
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
                            @if(!empty($getRecord))

                            <div class="tab-content">
                                <table class="table table-striped table-responsive">
                                    <thead class="thead-dark">
                                        <tr class="text-nowrap">
                                            <th>#</th>
                                            <th>Order Number</th>
                                            <th>Name</th>
                                            <th>Company Name</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Zip</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Discount Code</th>
                                            <th>Discount Amount</th>
                                            <th>Shipping Charge</th>
                                            <th>Shipping Amount</th>
                                            <th>Total Amount</th>
                                            <th>Payment Type</th>
                                            <th>Payment Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr class="text-nowrap">
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->order_number }}</td>
                                                <td>{{ $value->first_name }}</td>
                                                <td>{{ $value->company_name }}</td>
                                                <td>{{ $value->address_1 }} <br /> {{ $value->address_2 }}</td>
                                                <td>{{ $value->city }}</td>
                                                <td>{{ $value->state }}</td>
                                                <td>{{ $value->country }}</td>
                                                <td>{{ $value->zip_code }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ strtoupper($value->discount_code) }}</td>
                                                <td>{{ $value->discount_amount }}</td>
                                                <td>{{ $value->shipping_name }}</td>
                                                <td>{{ $value->shipping_amount }}</td>
                                                <td>{{ $value->total_amount }}</td>
                                                <td>{{ $value->payment }}</td>
                                                <td>
                                                    @if($value->status == 0)
                                                        Pending
                                                    @elseif($value->status == 1)
                                                        In progress
                                                    @elseif($value->status == 2)
                                                        Delivered
                                                    @elseif($value->status == 3)
                                                        Completed
                                                    @elseif($value->status == 4)
                                                        Cancelled
                                                    @endif
                                                </td>
                                                <td>{{ date('m-d-Y', strtotime($value->created_at)) }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ url('user/orders/detail/' . $value->id) }}"
                                                        class="btn btn-primary mr-2">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float: right;">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                            @else
                                <h3>No Orders Found</h3>
                            @endif
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
