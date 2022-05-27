<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\Faq;
use App\Models\Knowledgebase;

class ReportController extends Controller
{
    //
    // show the main report page
    public function index()
    {
        $user = auth()->user();
        $pageviews = DB::table('page_views')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
            ->groupBy('date')
            ->get();
        $total_users = User::count();
        $total_tickets = Ticket::count();
        $total_closed = Ticket::where('status', 'Closed')->count();
        $total_open = Ticket::where('status', '!=', 'Closed')->count();
        $total_faq = Faq::where('created_by', auth()->id())->count();
        $total_knowledge = Knowledgebase::where('created_by', auth()->id())->count();
        return Inertia::render('Admin/Report/Admin', [
            'pageviews' => $pageviews,
            'total_tickets' => $total_tickets,
            'total_closed' => $total_closed,
            'total_open' => $total_open,
            'total_users' => $total_users
        ]);
        // ddd($user->hasRole('Admin'));
        // if ($user->hasRole('Editor')) {
        //     $pageviews = DB::table('page_views')->count('views');
        //     return Inertia::render('Admin/Report/Editor', ['pageviews' => $pageviews]);
        // }
        // if ($user->hasRole('Agent')) {
        //     return Inertia::render('Admin/Report/Agent');
        // }
        // if ($user->hasRole('Admin')) {
        // $pageviews = DB::table('page_views')->select(DB::raw("DATE_FORMAT(created_at, '%m') new_date"),  DB::raw('count(*) as views'), DB::raw('MONTH(created_at) month'))
        //     ->groupby('new_date')
        //     ->get();

        // $pageviews = DB::table('page_views')->count('views');
        //     $pageviews = DB::table('page_views')
        //         ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
        //         ->groupBy('date')
        //         ->get();
        //     $total_users = User::count();
        //     $total_tickets = Ticket::count();
        //     $total_closed = Ticket::where('status', 'Closed')->count();
        //     $total_open = Ticket::where('status', '!=', 'Closed')->count();
        //     $total_faq = Faq::where('created_by', auth()->id())->count();
        //     $total_knowledge = Knowledgebase::where('created_by', auth()->id())->count();
        //     return Inertia::render('Admin/Report/Admin', [
        //         'pageviews' => $pageviews,
        //         'total_tickets' => $total_tickets,
        //         'total_closed' => $total_closed,
        //         'total_open' => $total_open,
        //         'total_users' => $total_users
        //     ]);
        // }
        // if ($user->hasRole('HOD')) {
        //     return Inertia::render('Admin/Report/HOD');
        // }
        // } else {
        //     $stuff = User::with('messages.ticket')->find(auth()->id());

        //     return Inertia::render('Admin/Report', ['stuff' => $stuff]);
        // }

        // now you can filter .. if user has the role of a anone
        //get the stuff I need
        // based on the filter that comes
        // return a query
        // write all of them
        // 1. this user
        // 1.1 a  user that is not this user
        // 2. this department and all users within
        // 2.1 one department and all users
        // 3. all departments and all users
        // different defaults
        // closed cases for this
        // get messages that user has replied to
        // get the tickets related to these messages
        // get the ones that are open and the ones that are closed
        // put them in one
        // $user = auth()->user();

    }
}
