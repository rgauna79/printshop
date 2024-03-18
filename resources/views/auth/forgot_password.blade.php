@extends('layouts.app')

@section('style')

@endsection

@section('content')

<main class="main">
    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" 
        style="background-image: url('{{ url('assets/images/backgrounds/login-bg.jpg') }}')">
        <div class="container">
            <div class="form-box ">
                <h3 class="mb-4 text-center">Forgot Password</h3>
                <div class="tab-content">
                    @include('admin.layouts._message')
                    <form action="" method="post" class="mt-2">
                        {{ @csrf_field() }}
                        <div class="form-group">
                            <label for="singin-email-2">Email address <span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="singin-email-2" name="email" required>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-outline-primary-2">
                                <span>FORGOT</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection
