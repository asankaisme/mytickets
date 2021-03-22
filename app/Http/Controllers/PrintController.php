<?php

namespace App\Http\Controllers;

use App\Ticket;
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
        $tickets = Ticket::all();
        
        $pdf = App::make('snappy.pdf.wrapper');
        $title = 'Status Report';
        
        $pdf->loadView('reports.statusRp', [
            'title' => $title,
            'tickets' => $tickets
        ]);
        $pdf->setOptions([
            'footer-right' => '[page]'
        ]);
        return $pdf->inline('Status.pdf');
    }
}
