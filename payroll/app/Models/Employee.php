<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use Notifiable, HasRoles;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'employees';
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'employment_type',
        'year_joined',
        'position_id',
        'department_id',
        'position',
        'department',
        'current_salary',
        'gender',
        'email',
        'contact',
        'employee_id',
        'salary_type',


    ];
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function payments()
    {
        return $this->hasMany(PaymentsHistory::class, 'employee_id');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    use HasFactory;


    use Notifiable;
}
