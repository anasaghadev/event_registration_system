<?php

namespace App\Exports;

use App\Models\Attendee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendeesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Attendee::select('name', 'email', 'phone', 'is_confirmed', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'البريد الإلكتروني',
            'رقم الجوال',
            'حالة الحضور',
            'تاريخ التسجيل'
        ];
    }

    public function map($attendee): array
    {
        return [
            $attendee->name,
            $attendee->email,
            $attendee->phone,
            $attendee->is_confirmed ? 'مؤكد' : 'غير مؤكد',
            $attendee->created_at->format('Y-m-d H:i')
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Header row
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '3490DC']]
            ],

            // Arabic alignment
            'A:E' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                ]
            ],

            // Set column widths
            'A' => ['width' => 30],
            'B' => ['width' => 35],
            'C' => ['width' => 20],
            'D' => ['width' => 15],
            'E' => ['width' => 20],
        ];
    }
}
