<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserNotificationsController extends Controller
{
    public function index(Request $request)
    {
        auth()->user()->unreadNotifications->markAsRead();
        $notifications = auth()->user()->notifications()->latest()->paginate();
        if ($request->wantsJson()) {
            return $notifications;
        }
        return Inertia::render('Admin/Notifications', [
            'notifications' => $notifications,
        ]);
    }
}
