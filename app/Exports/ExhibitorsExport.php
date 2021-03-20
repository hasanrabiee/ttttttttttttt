<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExhibitorsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function headings(): array
    {
        return [
            'Role',
            'UserName',
            'PhoneNumber',
            'Gender',
            'email',
            'City',
            'Country',
            'BirthDate',
            'companyAddress',
            'zipCode',
            'mainCompany',
            'institutionEmail',
            'phone',
            'fax',
            'institution'
        ];
    }

    public function collection()
    {
        return User::select('Rule','UserName', 'PhoneNumber','Gender','email','City','Country', 'BirthDate','companyAddress','zipCode','mainCompany','institutionEmail','phone','fax','institution')->whereIn('Rule', ['Exhibitor'] )->get();

    }
}
