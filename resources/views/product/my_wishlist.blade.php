@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
@endsection

@section('content')
    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ url('') }}/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">My Wishlist</h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">My Wishlist</a></li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @include('product._list')

                    </div>
                    <div class="col-lg-12" style="padding: 10px; float: right;">
                        {!! $getProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ url('assets/js/wNumb.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>

    <script src="{{ url('assets/js/nouislider.min.js') }}"></script>

    <script type="text/javascript"></script>
@endsection
