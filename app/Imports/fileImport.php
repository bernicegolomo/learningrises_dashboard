<?php

namespace App\Imports;

use App\Models\Scores;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class fileImport implements ToModel
{
    /**
    * @param Collection $collection
    */

    public function model(array $row)
    {
        dd($row); die();
        return new Scores([
           'name'     => $row[0],
           'email'    => $row[1], 
           'password' => Hash::make($row[2]),
        ]);
    }
}
