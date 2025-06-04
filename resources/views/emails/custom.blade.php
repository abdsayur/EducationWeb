@component('mail::message')
# {{ $subjectText }}

{{ $messageText }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent