@if (!empty(session('success')))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

@if (!empty(session('error_register')))
    <div class="alert alert-danger" role="alert">
        {{ session('error_register') }}
    </div>
@endif

@if (!empty(session('error_signin')))
    <div class="alert alert-danger" role="alert">
        {{ session('error_signin') }}
    </div>
@endif

@if (!empty(session('error_password')))
    <div class="alert alert-danger" role="alert">
        {{ session('error_password') }}
    </div>
@endif

@if (!empty(session('payment-error')))
    <div class="alert alert-success" role="alert">
        {{ session('payment-error') }}
    </div>
@endif

@if(!empty(session('success_email')))
    <div class="alert alert-success" role="alert">
        {{ session('success_email') }}
    </div>
@endif

@if(!empty(session('success_register')))
    <div class="alert alert-success" role="alert">
        {{ session('success-register') }}
    </div>
@endif

@if(!empty(session('success_update_profile')))
    <div class="alert alert-success" role="alert">
        {{ session('success_update_profile') }}
    </div>
@endif




@if (!empty(session('warning')))
    <div class="alert alert-warning" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (!empty(session('info')))
    <div class="alert alert-info" role="alert">
        {{ session('info') }}
    </div>
@endif

@if (!empty(session('secondary')))
    <div class="alert alert-secondary" role="alert">
        {{ session('secondary') }}
    </div>
@endif

@if (!empty(session('primary')))
    <div class="alert alert-primary" role="alert">
        {{ session('primary') }}
    </div>
@endif

@if (!empty(session('light')))
    <div class="alert alert-light" role="alert">
        {{ session('light') }}
    </div>
@endif