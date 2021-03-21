<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PrintController extends Controller
{
    public function getStatusRep()
    {
        return view('reports.repControl');
    }

    public function printStatusRpt()
    {
        
        $pdf = App::make('snappy.pdf.wrapper');
        $title = 'Status Report';
        
        $pdf->loadView('reports.statusRp', [
            'title' => $title,
        ]);
        $pdf->setOptions([
            'footer-right' => '[page]'
        ]);
        return $pdf->inline('Status.pdf');
    }
}
