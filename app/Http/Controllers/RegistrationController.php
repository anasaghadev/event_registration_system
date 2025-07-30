<?php

// namespace App\Http\Controllers;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\RegistrationConfirmation;
// use App\Models\Attendee;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class RegistrationController extends Controller
// {

//     // Show registration form
//     public function create()
//     {
//         return view('registration.form');
//     }
//     public function store(Request $request)
//     {
//         $data = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:attendees',
//             'phone' => 'required|string|max:20'
//         ]);

//         $attendee = Attendee::create($data);

//         // Generate QR
//         $qrCode = QrCode::format('png')->size(300)->generate($attendee->id);
//         $fileName = 'qr_' . $attendee->id . '.png';
//         Storage::put('public/qrcodes/' . $fileName, $qrCode);

//         // Update attendee
//         $attendee->update(['qr_code_path' => 'qrcodes/' . $fileName]);

//         // Send email
//         Mail::to($attendee->email)->send(new RegistrationConfirmation($attendee));

//         return redirect()->route('registration.success');
//     }
// }
namespace App\Http\Controllers;

use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
use App\Models\Attendee;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use BaconQrCode\Renderer\Image\GdImageBackEnd;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.form');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:attendees',
            'phone' => 'required|string|max:20',
        ]);

        $attendee = Attendee::create($data);

        $qrContent = json_encode([
            'id' => $attendee->id,
            'name' => $attendee->name,
            'email' => $attendee->email
        ]);

        // Ensure directory exists
        Storage::disk('public')->makeDirectory('public/qrcodes');

        // File path
        $fileName = 'qr_' . $attendee->id . '.png';
        $storagePath = 'qrcodes/' . $fileName;

        // Generate QR with Imagick
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );

        $writer = new Writer($renderer);
        $qrImage = $writer->writeString($qrContent);
        Storage::disk('public')->put($storagePath, $qrImage);

        // Save path in DB (relative path without 'public/')
        $attendee->update(['qr_code_path' => $storagePath]);

        // Send mail
        try {
            Mail::to($attendee->email)->send(new RegistrationConfirmation($attendee));
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
        }

        return redirect()->route('registration.success', ['attendee_id' => $attendee->id]);
    }

    public function success($attendee_id)
    {
        $attendee = Attendee::findOrFail($attendee_id);

        // Get filename only
        $filename = basename($attendee->qr_code_path);

        return view('registration.success', [
            'attendee' => $attendee,
            'qrCodePath' => asset('storage/qrcodes/' . $filename)
            // 'qrCodePath' => $filename
        ]);
    }

}
