@component('mail::message')

Hi <b>{{ $user->name }}</b>,

<p>You're almost ready to start enjoying the benefits of Print Shop.</p>

<p>Please click on the link below to activate your account.</p>

<p>
@component('mail::button', ['url' => url('/activate/'.base64_encode($user->id))])
Activate Account
@endcomponent
</p>

<p>This will verify your email and activate your account.</p>

@endcomponent