@component('mail::message')
# Ticket {{ '#'.$details['ticket']['number']}} created

A ticket has been created for your query. An agent will get back to you.

You can keep track of you tickets
@component('mail::button', ['url' => url("/ticket/view")])
View Tickets
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
