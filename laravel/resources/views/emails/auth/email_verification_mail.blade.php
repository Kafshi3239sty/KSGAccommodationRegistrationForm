@component('mail::message')
# Introduction

Hello {{$part->Full_Names}},

@component('mail::button', ['url' => ''])
Click here to verify your email address.
@endcomponent

<p>Or copy paste the following link on your web browser to verify your email address</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
