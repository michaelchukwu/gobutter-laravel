@component('mail::message')
# Ticket #{{$ticket->number}} has been closed

Hello {{$ticket->user->name}},

Your Ticket with number {{$ticket->number}} has been closed.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
