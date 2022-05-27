<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\User;
use App\Http\Traits\PageCount;

class PDFController extends Controller
{
    use PageCount;
    public function generatePDF($business)
    {
        $this->counter();
        $business = User::find($business);
        $business = $business->toArray();
        $pdf = PDF::loadView('myPDF', $business);
        $name = $business['business'];
        return $pdf->download("$name.pdf");
    }
}
