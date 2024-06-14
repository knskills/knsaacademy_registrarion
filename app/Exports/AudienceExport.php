<?php

namespace App\Exports;

use App\Models\audience;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

class AudienceExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    private $eventName;

    public function __construct($eventName)
    {
        $this->eventName = $eventName;
    }

    public function styles($sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Audience';
    }

    public function collection()
    {
        return audience::where('event_name', $this->eventName)->get();
    }

    public function map($audience): array
    {
        return [
            $audience->id,
            $audience->name,
            $audience->phone,
            $audience->email,
            $audience->event_name,
            $audience->created_at->format('d-m-Y'),
            $audience->created_at->format('h:i A'),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Mobile',
            'Email',
            'Event Name',
            'Registration Date',
            'Registration Time',
        ];
    }
}
