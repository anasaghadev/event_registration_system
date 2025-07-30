<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function exportPDF()
    {
        $attendees = Attendee::cursor(); // Uses lazy collection

        // $pdf = Pdf::loadView('reports.attendees', compact('attendees'));
        $pdf = Pdf::loadView('reports.attendees', compact('attendees'))
            ->setPaper('a4', 'landscape')
            ->setOption('isPhpEnabled', true)
            ->setOption('isRemoteEnabled', true);

        return $pdf->download('تقرير_الحضور.pdf');
    }
}
