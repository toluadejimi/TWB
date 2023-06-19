@component('mail::message')

Hi {{ $data1['name'] }},<br><br>

{{ __('We like to inform you that your wallet has been funded') }}
<br><br>
{{ __('Amount') }} <br>
<strong>NGN {{ $data1['amount'] }}</strong>.<br><br>





{{ __('Thank Your ') }} <br>
{{ config('app.name') }}
