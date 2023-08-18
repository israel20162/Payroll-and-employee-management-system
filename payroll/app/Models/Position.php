<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'positions';
     protected $fillable = [
        'name',
        'fixed_salary',
        'role_id'
    ];

     public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

}
