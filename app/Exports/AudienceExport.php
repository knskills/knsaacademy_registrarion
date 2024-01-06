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
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function styles($data)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Audiance';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return audience::all();
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->name,
            $customer->phone,
            $customer->email,
            $customer->event_name,
            $customer->created_at->format('d-m-Y'),
            $customer->created_at->format('h:i A'),
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
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
