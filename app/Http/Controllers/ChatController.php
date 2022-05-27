<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ChatController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:Admin');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:chat,reply,created_at,updated_at']
        ]);

        $query = Chat::query();

        if (request('search')) {
            $query->where('chat', 'LIKE', '%' . request('search') . '%')
                ->orWhere('reply', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }
        if (request()->has(['start_date', 'end_date'])) {
            $query->whereDate('created_at', '>=', request('start_date'))->whereDate('created_at', '<=', request('end_date'));
        }
        return Inertia::render('Admin/Chat/Index', [
            'users' => $query->paginate(),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sug = DB::table('chat_suggestions')->whereNotIn(
            'chat',
            DB::table('chats')->pluck('chat')->toArray()
        )->take(10)->orderByDesc('count')->get();
        return Inertia::render('Admin/Chat/Create', ['suggestions' => $sug]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'chat' => 'required',
            'reply' => 'required',

        ]);
        try {
            Chat::create([
                'chat' => $request->get('chat'),
                'reply' => $request->get('reply'),
                'user_id' => auth()->id(),
            ]);
            return redirect()->route('kitchn.chat.index')->with('success', 'Chat created successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('error', 'Not created ');
            // return back()->with('error', 'Not created: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        return Inertia::render('Admin/Chat/Edit', [
            'chat' => $chat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        $val = $request->validate([
            'chat' => 'required',
            'reply' => 'required'
        ]);
        $chat->chat = $request['chat'];
        $chat->reply = $request['reply'];

        $chat->updated_at = now();


        if ($chat->save()) {
            return back()->with('success', 'Chat updated successfully');
        } else {
            return back()->with('error', 'Chat did not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        $chat->delete();
        return redirect()->route('kitchn.chat.index')->with('success', 'Chat Deleted Successfully');
    }
}
