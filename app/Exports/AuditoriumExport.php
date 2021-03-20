<?php

namespace App\Exports;

use App\Auditorium;
use App\Conference;
use App\Speaker;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AuditoriumExport implements FromCollection , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Conference::all();
    }

    public function headings(): array
    {
        return [
            'Speech Title',
            'Speakers',
            'Conference Date',
            'Start Time',
            'End Time',

        ];
    }

    public function map($row): array
    {



        return [
            $row->title,
            Speaker::where('cid',$row->crid)->get(['email'])->implode('email',' | '),
            Carbon::parse($row->start_date)->format('Y-m-d'),
            Carbon::parse($row->start_time)->format('H:i'),
            Carbon::parse($row->end_time)->format('H:i'),
        ];
    }
}
