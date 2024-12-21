<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class fileExport implements FromCollection, WithHeadings
{
    protected $data, $header;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($data,$header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    public function collection()
    {
        //
        return collect($this->data);
    }

    public function headings(): array
    {
        return $this->header;
        //return [
        //    'id',
        //    'Name',
        //    'Email',
        //];
    }
}
