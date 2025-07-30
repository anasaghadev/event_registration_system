<?php

namespace App\Http\Controllers;

use App\Exports\AttendeesExport;
use App\Models\Attendee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    public function dashboard()
    {
        $totalAttendees = Attendee::count();
        $confirmedAttendees = Attendee::where('is_confirmed', true)->count();
        $attendees = Attendee::paginate(20);

        $attendees = Attendee::paginate(20);
        return view('admin.dashboard', compact('totalAttendees', 'confirmedAttendees', 'attendees'));
    }
    // Search and filter
    public function index(Request $request)
    {
        // Existing code...
        $totalAttendees = Attendee::count();
        $confirmedAttendees = Attendee::where('is_confirmed', true)->count();
        $attendees = Attendee::paginate(20);

        return view('admin.dashboard', compact('attendees', 'totalAttendees', 'confirmedAttendees'));
    }

    // Confirm attendance
    public function confirm(Attendee $attendee)
    {
        $attendee->update(['is_confirmed' => true]);
        return back()->with('success', 'تم تأكيد الحضور');
    }

    // Reports
    public function exportExcel()
    {
        return Excel::download(new AttendeesExport, 'المسجلين.xlsx');
    }
}
