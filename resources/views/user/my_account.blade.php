@extends('layouts.app')

@section('style')
@endSection

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">My Account</h1>
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

                                <div class="row mb-3">
                                    <p>Hello <span class="font-weight-normal text-dark">{{ Auth::user()->first_name }}</span> (not <span class="font-weight-normal text-dark">User</span>? <a href="{{ url('logout') }}">Log out</a>) 
								    	<br>
								    	From your account dashboard you can view your <a href="{{ url('user/orders') }}">recent orders</a>, manage your <a href="{{ url('user/address') }}" >shipping and billing addresses</a>, and <a href="{{ url('user/detail') }}" >edit your password and account details</a>.</p>
                                </div>
                                <div class="row" style="height: 100px">
                                    <div class="col-12 col-sm-6 col-md-3 ">
                                        <div class="d-flex flex-column align-items-center text-center p-4 rounded shadow h-100 justify-content-top">
                                                <span class="font-weight-bold d-block">
                                                    {{ $getTotalOrders }}
                                                </span>
                                                <span class="info-box-text">Total Orders</span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="d-flex flex-column align-items-center text-center p-4 rounded shadow h-100 justify-content-top">
                                                <span class="font-weight-bold d-block">
                                                    {{ $getTodayOrders }}
                                                </span>
                                                <span class="info-box-text">Today Orders</span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="d-flex flex-column align-items-center text-center p-4 rounded shadow h-100 justify-content-top">
                                                <span class="font-weight-bold d-block">
                                                    {{ $getInProgressOrders }}
                                                </span>
                                                <span class="info-box-text">In Progress Orders</span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="d-flex flex-column align-items-center text-center p-4 rounded shadow h-100 justify-content-top">
                                                <span class="font-weight-bold d-block">
                                                    {{ $getPendingOrders }}
                                                </span>
                                                <span class="info-box-text">Pending Orders</span>
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

