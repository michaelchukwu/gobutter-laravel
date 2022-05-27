<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:title,created_at,updated_at']
        ]);

        $query = Service::query();

        if (request('search')) {
            $query->where('title', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }
        if (request()->has(['start_date', 'end_date'])) {
            $query->whereDate('created_at', '>=', request('start_date'))->whereDate('created_at', '<=', request('end_date'));
        }
        return Inertia::render('Admin/Service/Index', [
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
        return Inertia::render('Admin/Service/Create');
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
            'title' => 'required',
            'description' => 'nullable'
        ]);
        try {
            $request['slug'] = Str::slug($request['title'], '-');

            $service = Service::create($request->all());
            return redirect()->route('kitchn.service.index')->with('success', 'Service created successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('error', 'Not created ');
            // return back()->with('error', 'Not created: ' . $ex->getMessage());
        }
    }


    public function show(Service $service)
    {
        //
    }

    public function edit(Service $service)
    {
        return Inertia::render('Admin/Service/Edit', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $val = $request->validate([
            'title' => 'required',
        ]);
        $service->title = $request['title'];
        $service->slug = $request['slug'];
        $service->description = $request['description'];

        $service->updated_at = now();
        if ($service->save()) {
            return back()->with('success', 'Service updated successfully');
        } else {
            return back()->with('error', 'Service did not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {

        $service->delete();
        return redirect()->route('kitchn.service.index')->with('success', 'Delete Successfull');
    }
}
