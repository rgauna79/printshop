@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order List</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts._message')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order List</h3>
                        </div>
                        
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>#</th>
                                            <th>Customer Name</th>
                                            <th>Discount Code</th>
                                            <th>Discount Amount</th>
                                            <th>Shipping Charge</th>
                                            <th>Shipping Amount</th>
                                            <th>Total Amount</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
                                            <th>Payment Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->first_name }}</td>
                                                <td>{{ strtoupper($value->discount_code) }}</td>
                                                <td>{{ $value->discount_amount }}</td>
                                                <td>{{ $value->shipping_name }}</td>
                                                <td>{{ $value->shipping_amount }}</td>
                                                <td>{{ $value->total_amount }}</td>
                                                <td>{{ $value->payment }}</td>
                                                <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ ($value->is_completed == 0) ? 'Paid' : 'Unpaid' }}</td>
                                                <td>{{ date('m-d-Y', strtotime($value->created_at)) }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ url('admin/orders/edit/'.$value->id)}}" class="btn btn-primary mr-2">Edit</a>
                                                    <a href="{{ url('admin/orders/delete/'.$value->id)}}" class="btn btn-danger ">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding: 10px; float: right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->
                                links() !!}
                            </div>
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