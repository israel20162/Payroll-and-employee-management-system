<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentsHistory extends Model
{ /**
  * The primary key associated with the table.
  *
  * @var string
  */
    protected $primaryKey = 'id';
    protected $table = 'payments_history';
    protected $fillable = [
        'payment_date',
        'status',
        'amount',
        'tax',
        'deductions',
        'bonus',
        'employee_id',
        'start_date',
        'end_date',
        'month',
        'year',
        'net_pay'
    ];
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    use HasFactory;
}
