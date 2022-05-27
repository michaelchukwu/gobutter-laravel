@component('mail::message')
# Ticket #{{$sendr['ticket']->number}}

Hello {{$sendr['ticket']->user->name}},

{{$sendr['message']->body}}




{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Best Regards,<br>
{{$sendr['message']->user->name}}, Customer Agent
<br>
{{ config('app.name') }}
@endcomponent
