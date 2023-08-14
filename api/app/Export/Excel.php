<?php

namespace App\Export;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class Excel implements FromCollection
{

    public function collection()
    {
        return \App\Appointment::all();
    }
}