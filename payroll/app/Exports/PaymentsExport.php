<?php

namespace App\Exports;

use App\Models\PaymentHistory;
use App\Models\PaymentsHistory;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PaymentsHistory::all();
    }
}
