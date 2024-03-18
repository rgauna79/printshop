@component('mail::message')

Hi <b>{{ $user->name }}</b>,

<p>We have received a request to reset your password. Please click on the link below to reset your password.</p>

@component('mail::button', ['url' => url('/reset/'.$user->remember_token)])
Reset Password
@endcomponent
</p>

<p>In case you did not request a password reset, please ignore this email or contact us</p>

Thank you for using our application.<br>
{{ config('app.name') }}
@endcomponent