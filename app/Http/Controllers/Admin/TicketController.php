<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TicketsExport;
use App\Http\Controllers\Controller;
use App\Mail\TicketClosed;
use App\Mail\TicketUpdated;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Inertia\Inertia;
use App\Models\Message;
use App\Models\Rating;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\TicketClosed as TicketClosedNotification;
use App\Notifications\TicketForwarded;

class TicketController extends Controller
{
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:number,status,created_at,updated_at']
        ]);

        $query = Ticket::query();
        if (auth()->user()->hasRole('HOD')) {
            if (request('search')) {
                $query->where('number', 'LIKE', '%' . request('search') . '%');
                // ->orWhere('status', 'LIKE', '%' . request('search') . '%');
            }
        }
        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }
        if (request()->has(['start_date', 'end_date'])) {
            $query->whereDate('created_at', '>=', request('start_date'))->whereDate('created_at', '<=', request('end_date'));
        }
        if (auth()->user()->hasRole('Admin')) {

            return Inertia::render('Admin/Tickets/Index', [
                'tickets' => $query->with('messages.user')->with('user')->with('service')->latest()->paginate(),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]);
        } else {
            return Inertia::render('Admin/Tickets/Index', [
                'tickets' => $query->with('messages.user')->with('user')->with('service')->whereHas('service', function ($q) {
                    $q->where('services.id', auth()->user()->departments[0]->id);
                })->latest()->paginate(),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]);
        }
    }
    public function edit(Ticket $ticket)
    {
        $ticket = [
            'ticket' => $ticket,
            'messages' => Message::where('ticket_id', $ticket->id)->orderBy('id', 'DESC')->with('user.roles')->get(),
            'user' => User::where('id', $ticket->user_id)->first(),
            'service' => Service::where('id', $ticket->service_id)->first(),
            'quicks' => DB::table('quicks')->where('is_active', true)->get(),
            'rating' => Rating::where('ticket_id', $ticket->id)->first()
        ];
        return Inertia::render('Admin/Tickets/Edit', ['ticket' => $ticket]);
    }
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required',
        ]);
        $message = Message::create([
            'ticket_id' => $ticket->id,
            'subject' => null,
            'ip' => $request->ip(),
            'status' => 'Awaiting Response',
            'user_id' => auth()->id(),
            'body' => $request->input('message')
        ]);
        // update the message before this one to replied
        $ticket->status = "In Progress";
        $ticket->updated_at = now();
        $ticket->save();
        $sendr = ['ticket' => $ticket, 'message' => $message];
        Mail::to($ticket->user->email)->send(new TicketUpdated($sendr));

        return back()->with('success', 'Reply Successful');
    }
    public function destroy(Ticket $ticket)
    {

        $ticket->delete();
        return redirect()->route('kitchn.ticket.index')->with('success', 'Delete Successful');
    }
    public function close(Ticket $ticket)
    {
        $ticket->status = "Closed";
        $ticket->closer = auth()->id();
        $ticket->save();
        $service = Service::find($ticket->service_id);
        $users = $service->users;
        foreach ($users as $user) {
            $user->notify(new TicketClosedNotification($ticket, $user));
        }
        Mail::to($ticket->user->email)->send(new TicketClosed($ticket));
        return redirect()->route('kitchn.ticket.index')->with('success', 'Ticket #' . $ticket->number . ' has been closed.');
    }
    public function forward(Ticket $ticket, Request $request)
    {
        DB::table('forwards')->insert([
            'from' => auth()->id(),
            'to' => $request->get('agent'),
            'ticket' => $ticket->id,
            'comment' => $request->get('comment')
        ]);
        $ticket->service_id = $request['department'];
        $ticket->save();
        $user = User::find($request->get('agent'));

        $user->notify(new TicketForwarded($ticket, $user, auth()->user(), $request->get('comment')));
        return redirect()->route('kitchn.ticket.index')->with('success', 'Ticket #' . $ticket->number . ' has been forwarded.');
    }
    public function getAgents($dept)
    {
        $dept = Service::find($dept);
        return $dept->users;
    }
    public function export()
    {
        return Excel::download(new TicketsExport, 'tickets-' . now() . '.xlsx');
        // return back();

    }
}
