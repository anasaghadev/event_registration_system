<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function showForm()
    {
        return view('attendance.confirm');
    }

    public function confirmAttendance(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'attendee_id' => 'required|integer|exists:attendees,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $attendee = Attendee::find($request->attendee_id);

        // Check if already confirmed
        if ($attendee->is_confirmed) {
            return view('attendance.result', [
                'success' => false,
                'message' => 'تم تأكيد الحضور مسبقاً',
                'attendee' => $attendee,
            ]);
        }

        // Mark as confirmed
        $attendee->is_confirmed = true;
        $attendee->save();

        return view('attendance.result', [
            'success' => true,
            'message' => 'تم تأكيد الحضور بنجاح',
            'attendee' => $attendee,
        ]);
    }
}
