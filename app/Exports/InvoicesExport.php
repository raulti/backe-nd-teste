<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    private $countrys;

    public function __construct($countrys) {
        $this->countrys = $countrys;
    }

    public function headings(): array
    {
        return [
            'Sigla',
            'Nome'
        ];
    }

    public function collection()
    {
        return new Collection($this->countrys);
    }
}