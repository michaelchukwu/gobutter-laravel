@component('mail::message')
# Ticket {{ '#'.$details['ticket']['number']}} created

A ticket has been created for your query. An agent will get back to you.

Please login using this password : {{$details['password']}}
@component('mail::button', ['url' => url("/ticket")])
View Tickets
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
