@component('mail::message')
# Introduction

Sofra Reset Password 

@component('mail::button', ['url' => 'https://www.google.com'])
Reset
@endcomponent

<p>Your Password Reset Code is : {{ $code }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
