<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Service;
use Inertia\Middleware;
use Spatie\Permission\Models\Role;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'isAdmin' => $request->user() ? $request->user()->hasRole('Admin') : NULL,
            'isHOD' => $request->user() ? $request->user()->hasRole('HOD') : NULL,
            'isEditor' => $request->user() ? $request->user()->hasRole('Editor') : NULL,
            'unreadNotificationsCount' => $request->user() ? $request->user()->unreadNotifications()->count() : 0,
            'menu' => Menu::all(),
            'menu_1' => function () {
                $parent_menu = Menu::whereNull('parent')->get();
                $stuff = [];
                $i = 0;
                foreach ($parent_menu as $par) {
                    $stuff[$i] = [
                        'parent' => $par,
                        'child' => Menu::where('parent', $par->id)->where('location', 1)->get(),
                        'child_1' => Menu::where('parent', $par->id)->where('location', 2)->get()
                    ];
                    $i++;
                }
                return $stuff;
            },
            'services' => Service::all(),
            'roles' => Role::all(),
            'temp' => fn () => $request->session()->get('temp'),
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
        ]);
    }
}
