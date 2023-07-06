<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     *
     */
    protected $primaryKey = 'id';
    protected $table = 'departments';
    protected $fillable = [
        'name',
        

    ];
    protected $GLOBALS;

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
