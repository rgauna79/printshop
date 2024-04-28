@extends('layouts.app')

@section('style')
@endSection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('../assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Addresses</h1>
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

                                <p>The following addresses will be used on the checkout page by default.</p>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">Billing Address</h3>
                                                @include('admin.layouts._message')
                                                <form id="form_address" action="{{ url('user/update_address') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label for="phone">Phone <span style="color:red">*</span></label>
                                                        <input value="{{ old('phone', !empty($getUserInfo->phone) ? $getUserInfo->phone : '') }}"
                                                            id="phone" type="text" name="phone" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company_name">Company Name</label>
                                                        <input
                                                            value="{{ old('company_name', !empty($getUserInfo->company_name) ? $getUserInfo->company_name : '') }}"
                                                            id="company_name" type="text" name="company_name" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address_1">Address line 1 <span style="color:red">*</span></label>
                                                        <input
                                                            value="{{ old('address_1', !empty($getUserInfo->address_1) ? $getUserInfo->address_1 : '') }}"
                                                            id="address_1" type="text" name="address_1" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address_2">Address line 2</label>
                                                        <input
                                                            value="{{ old('address_2', !empty($getUserInfo->address_2) ? $getUserInfo->address_2 : '') }}"
                                                            id="address_2" type="text" name="address_2" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">City <span style="color:red">*</span></label>
                                                        <input value="{{ old('city', !empty($getUserInfo->city) ? $getUserInfo->city : '') }}"
                                                            id="city" type="text" name="city" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="state">State <span style="color:red">*</span></label>
                                                        <input value="{{ old('state', !empty($getUserInfo->state) ? $getUserInfo->state : '') }}"
                                                            id="state" type="text" name="state" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="zip_code">Zip Code <span style="color:red">*</span></label>
                                                        <input
                                                            value="{{ old('zip_code', !empty($getUserInfo->zip_code) ? $getUserInfo->zip_code : '') }}"
                                                            id="zip_code" type="text" name="zip_code" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country">Country <span style="color:red">*</span></label>
                                                        <input value="{{ old('country', !empty($getUserInfo->country) ? $getUserInfo->country : '') }}"
                                                            id="country" type="text" name="country" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="notes">Notes</label>
                                                        <textarea value="{{ old('notes', !empty($getUserInfo->notes) ? $getUserInfo->notes : '') }}" id="notes"
                                                            type="text" name="notes" class="form-control">
                                                        </textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </form>
                                                {{-- <a href="#">Edit <i class="icon-edit"></i></a></p> --}}
                                
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
    <script type="text/javascript">

        

        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: "{{ url('user/get-user-address') }}",
                success: function(data) {
                    // if session success
                    var success = "{{ session('success') }}";
                    if (success) {
                        //clean success message and hide it after 3 seconds
                        setTimeout(function() {
                            $('.alert-success').remove();
                        }, 3000);
                    }
                },
                error: function(data) {
                }
            });
        });
    </script>
@endSection
