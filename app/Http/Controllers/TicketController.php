<?php

namespace App\Http\Controllers;

use App\Mail\TicketCreated;
use App\Models\Message;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Rating;
use App\Http\Resources\Rating as RatingResource;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TicketCreated as TicketCreatedNotification;
use App\Http\Traits\PageCount;
use App\Notifications\UserResponded;

class TicketController extends Controller
{
    use PageCount;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->counter();
        //check if user is logged in and serve the view accordingly
        if (auth()->check()) {
            return Inertia::render('Ticket/AuthCreate');
        } else {
            return Inertia::render('Ticket/Create');
        }
    }
    public function submitted()
    {
        //

        return Inertia::render('Ticket/Submitted');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = "";
        $user = User::where('email', $request->input('email'))->first();
        $user_status = 'old';
        $service_id = $request->input('service');
        if (is_null($user)) {
            $user_status = 'new';
            $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                . '0123456789!@#$%^&*()');
            shuffle($seed);
            $rand = '';
            foreach (array_rand($seed, 8) as $k) $rand .= $seed[$k];
            $password = $rand;
            $user = User::create([
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'password' => bcrypt($password),
                'address' => $request->input('address'),
                'msme' => $request->input('msme'),
                'phone' => $request->input('phone'),
                'business' => $request->input('business'),
                'category' => $request->input('category')['title'],
                'state' => $request->input('state')
            ]);
            $user->assignRole('User');
            foreach ($request->products as $product) {
                DB::table('products')->insert(['user_id' => $user->id, 'title' => $product]);
            }
        }
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            . '0123456789');
        shuffle($seed);
        if (gettype($service_id) == "array") {
            $service_id = $service_id['id'];
        }
        $rand = '';
        foreach (array_rand($seed, 8) as $k) $rand .= $seed[$k];
        $ticket = Ticket::create([
            'number' => $rand,
            'user_id' => $user->id,
            'status' => 'Awaiting Response',
            'service_id' => $service_id
        ]);
        $message = Message::create([
            'ticket_id' => $ticket->id,
            'subject' => $request->input('subject'),
            'body' => $request->input('message'),
            'ip' => $request->ip(),
            'status' => 'Awaiting Response',
            'user_id' => $user->id
        ]);
        $temp = [
            'password' => $password,
            'user_status' => $user_status,
            'status' => 'submitted',
            'ticket' => $ticket,
            'message' => $message,
            'user' => $user,

            'service' => Service::where('id', $ticket->service_id)->first()
        ];

        // send an email for user created
        // send an email for ticket created
        Mail::to($user->email)->send(new TicketCreated($temp));
        // get the users from the department
        $service = $temp['service'];
        $users = $service->users;
        // loop them
        // and notify each of them
        foreach ($users as $user) {
            $user->notify(new TicketCreatedNotification($ticket, $user));
        }
        // return back()->with('temp', $temp);
        // return redirect()->route('ticket.temp', ['ticket' => $ticket->number])->with('success', 'Ticket Submitted successfully');
        if (auth()->check()) {
            return redirect()->route('ticket.show', ['ticket' => $ticket]);
        } else {
            return redirect()->route('ticket.submitted')->with('temp', $temp);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $this->counter();

        if ($ticket->user_id != auth()->id()) {
            abort(404);
        }
        $rating = Rating::where('user_id', auth()->id())->where('ticket_id', $ticket->id)->first();
        $ticket = [
            'ticket' => $ticket,
            'messages' => Message::where('ticket_id', $ticket->id)->orderBy('id', 'DESC')->with('user.roles')->get(),
            'user' => User::where('id', $ticket->user_id)->first(),
            'service' => Service::where('id', $ticket->service_id)->first()
        ];
        return Inertia::render('Ticket/Show', ['ticket' => $ticket, 'rating' => $rating]);
    }
    public function view()
    {
        $this->counter();

        $tickets = Ticket::where('user_id', auth()->id())->with('messages.user')->with('service')->latest()->paginate();
        // $tickets = Ticket::where('user_id', auth()->id())->with('messages')->paginate();
        // dd($tickets);
        return Inertia::render('Ticket/View', ['tickets' => $tickets]);
    }
    public function reply(Request $request)
    {
        $ticket = Ticket::find($request->input('ticket'));
        Message::create([
            'ticket_id' => $ticket->id,
            'subject' => null,
            'ip' => $request->ip(),
            'status' => 'Awaiting Response',
            'user_id' => auth()->id(),
            'body' => $request->input('message')
        ]);
        $ticket->status = "Awaiting Response";
        $ticket->updated_at = now();
        $ticket->save();
        // get all the messages form the ticket
        $messages = collect(Message::where('ticket_id', $ticket->id)->get());
        $messagesUnique = $messages->unique('recipient_id');
        $messagesUnique->values()->all();
        // get the users from the this that are agents
        foreach ($messagesUnique as $message) {
            $user = $message->user;
            $user->notify(new UserResponded($ticket, $user));
        }
        return back()->with('success', 'Reply Sent');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
    public function setrating(Request $request)
    {
        new RatingResource(Rating::create([
            'rating' => $request->get('rating'),
            'user_id' => auth()->id(),
            'ticket_id' => $request->get('ticket')['ticket']['id']
        ]));
        return back();
    }
    public function gallery()
    {
        $query = Image::query();
        if (request('search')) {
            $query->where('title', 'LIKE', '%' . request('search') . '%');
        }

        return Inertia::render('Gallery', ['images' => $query->paginate(), 'filters' => request()->all(['search'])]);
    }
}
