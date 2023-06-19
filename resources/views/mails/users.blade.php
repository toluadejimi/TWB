<x-mail::message>
# {{ $details['subject'] }}

{{ $details['message'] }}

<x-mail::button :url="''">
Oprime
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
