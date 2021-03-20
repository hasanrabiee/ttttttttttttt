<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function headings(): array
    {
        return [
            'Role',
            'FirstName',
            'LastName',
            'UserName',
            'PhoneNumber',
            'Gender',
            'email',
            'City',
            'Country',
            'BirthDate',
            'VisitExperience',
            'education',
            'countryStudy',
            'InterestedDegree',
            'InterestedField',
            'languageOfStudy',
            'onlineDegreeProgram',
            'interestedScholarShip',
        ];
    }


    public function collection()
    {
//        return User::all();
        return User::select('Rule','FirstName', 'LastName', 'UserName', 'PhoneNumber','Gender','email','City','Country', 'BirthDate','VisitExperience','education','countryStudy','InterestedDegree','InterestedDegree','InterestedField','languageOfStudy','onlineDegreeProgram','interestedScholarShip')->whereIn('Rule', ['Visitor'] )->get();

    }
}
