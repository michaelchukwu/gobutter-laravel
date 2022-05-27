<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Http\Traits\PageCount;
use Inertia\Inertia;
use App\Models\Faq;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\Service;

class DashboardController extends Controller
{
    use PageCount;
    public function welcome()
    {
        $this->counter();
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
    public function dashboard()
    {
        $this->counter();
        $tickets = Ticket::where('user_id', auth()->id())->with('messages.user')->with('service')->latest()->limit(3)->get();
        return Inertia::render('Ticket/Index', ['tickets' => $tickets]);
    }
    public function faq()
    {
        $this->counter();
        $faqs = Faq::all();
        return Inertia::render('Ticket/Faq', ['faqs' => $faqs]);
    }
    public function service()
    {
        $this->counter();
        $faqs = Service::all();
        return Inertia::render('Ticket/Service', ['services' => $faqs]);
    }
}
