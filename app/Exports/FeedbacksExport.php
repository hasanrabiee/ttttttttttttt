<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class FeedbacksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function headings(): array
    {
        return [
            'FirstName',
            'LastName',
            'UserName',
            'email',
            'VisitExperience'
        ];
    }

    public function collection()
    {
        return User::select( 'FirstName',
            'LastName',
            'UserName',
            'email',
            'VisitExperience')->whereIn('Rule', ['Visitor'] )->get();

    }
}
