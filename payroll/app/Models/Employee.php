<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'employees';

      protected $fillable = [
        'name',
        'employment_type',
        'year_joined',
        'position_id',
        'department_id',
        'email',
        'contact',
        'employee_id',
        'salary_type',
        'password',
    ];
  public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class,'department_id');
    }
    use HasFactory;
}
