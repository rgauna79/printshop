@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer List (Total: {{ $getRecord->total() }})</h1>
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
                                                <label>Customer ID</label>
                                                <input type="text" placeholder="Customer ID" class="form-control"
                                                    name="id" value="{{ Request::get('id') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Display Name</label>
                                                <input type="text" placeholder="Display Name" class="form-control"
                                                    name="name" value="{{ Request::get('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" placeholder="First Name" class="form-control"
                                                    name="first_name" value="{{ Request::get('first_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" placeholder="Last Name" class="form-control"
                                                    name="last_name" value="{{ Request::get('last_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" placeholder="Email" class="form-control"
                                                    name="email" value="{{ Request::get('email') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <input type="date" class="form-control" name="from_date"
                                                    value="{{ Request::get('from_date') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <input type="date" class="form-control" name="to_date"
                                                    value="{{ Request::get('to_date') }}">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <a href="{{ url('admin/customer/list') }}" class="btn btn-default">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Customer List</h3>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Display Name</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getRecord as $value)
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->first_name }}</td>
                                                    <td>{{ $value->last_name }}</td>
                                                    <td>{{ $value->email }}</td>
                                                    <td>{{ $value->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                    <td>{{ date('m-d-Y h:i A', strtotime($value->created_at)) }}</td>
                                                    <td class="d-flex">
                                                        <a href="{{ url('admin/admin/delete/' . $value->id) }}"
                                                            class="btn btn-danger ">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div style="padding: 10px; float: right;">
                                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->
                                        links() !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div style="padding: 10px; float: right;">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->
                        links() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
@endsection
