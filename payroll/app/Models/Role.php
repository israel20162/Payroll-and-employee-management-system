<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
   protected $table = 'roles';
    protected $fillable = [
        'role_id',
        'model_id'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
