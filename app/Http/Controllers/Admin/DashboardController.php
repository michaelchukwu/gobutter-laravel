<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Knowledgebase;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('Admin')) {
            $total_users = User::with('departments')->whereHas('departments', function ($q) {
                $q->where('services.id', auth()->user()->departments[0]->id);
            })->count();
            $total_tickets = Ticket::where('service_id', auth()->user()->departments[0]->id)->count();
            $total_closed = Ticket::where('service_id', auth()->user()->departments[0]->id)->where('status', 'Closed')->count();
            $total_open = Ticket::where('service_id', auth()->user()->departments[0]->id)->where('status', '!=', 'Closed')->count();
            $total_faq = Faq::count();
            $total_knowledge = Knowledgebase::count();
        } else {
            $total_users = User::count();
            $total_tickets = Ticket::count();
            $total_closed = Ticket::where('status', 'Closed')->count();
            $total_open = Ticket::where('status', '!=', 'Closed')->count();
            $total_faq = Faq::where('created_by', auth()->id())->count();
            $total_knowledge = Knowledgebase::where('created_by', auth()->id())->count();
        }

        return Inertia::render('Admin/Index', [
            'total_users' => $total_users,
            'total_tickets' => $total_tickets,
            'total_closed' => $total_closed,
            'total_open' => $total_open,
            'total_faq' => $total_faq,
            'total_knowledge' => $total_knowledge
        ]);
    }
}
