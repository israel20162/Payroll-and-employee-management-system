<?php

namespace App\Exports;


use App\Models\PaymentsHistory;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class PaymentsExport implements FromQuery
{

    public $month;
    public $year;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PaymentsHistory::all();
    }
    use Exportable;

    public function __construct(string $month,int $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function query()
    {
        return PaymentsHistory::query()->where('month', $this->month)->where('year',$this->year);
    }
}