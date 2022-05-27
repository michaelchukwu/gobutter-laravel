<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list all the backups
        $files = Storage::files('backup');
        return Inertia::render('Backup', [
            'files' => $files
        ]);
    }

    public function dl($folder, $file)
    {
        $f = $folder . "/" . $file;
        $fi = Storage::download($f);
        return (new Response($fi, 200))
            ->header('Content-Type', 'application/gzip');
    }
    public function rm($folder, $file)
    {
        $f = $folder . "/" . $file;
        $fi = Storage::delete($f);

        return back();
    }
}
