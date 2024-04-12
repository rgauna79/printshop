@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order List ( Total:  {{ $getRecord->total() }})</h1>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.layouts._message')

                        <form method="get">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Search</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Order ID</label>
                                                <input type="text" placeholder="Order ID" class="form-control" name="order_id" value="{{ Request::get('order_id')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <input type="text" placeholder="Company Name" class="form-control" name="company_name" value="{{ Request::get('company_name')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" placeholder="First Name" class="form-control" name="first_name" value="{{ Request::get('first_name')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" placeholder="Last Name" class="form-control" name="last_name" value="{{ Request::get('last_name')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" placeholder="Email" class="form-control" name="email" value="{{ Request::get('email')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" placeholder="Phone" class="form-control" name="phone" value="{{ Request::get('phone')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" placeholder="City" class="form-control" name="city" value="{{ Request::get('city')}}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>State</label>
                                                <input type="text" placeholder="State" class="form-control" name="state" value="{{ Request::get('state')}}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" placeholder="Country" class="form-control" name="country" value="{{ Request::get('country')}}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Zip code</label>
                                                <input type="text" placeholder="Zip code" class="form-control" name="zip_code" value="{{ Request::get('zip_code')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <input type="date"  class="form-control" name="from_date" value="{{ Request::get('from_date')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <input type="date"  class="form-control" name="to_date" value="{{ Request::get('to_date')}}">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <a href="{{ url('admin/orders/list') }}" class="btn btn-default">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>

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
                                            <tr>
                                                <td>{{ $value->id }}</td>
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
                                                {{-- <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td> --}}
                                                <td>{{ $value->is_completed == 1 ? 'Paid' : 'Unpaid' }}</td>
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
                            <div style="padding: 10px; float: right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
