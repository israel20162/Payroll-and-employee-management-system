<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'assignee_id',
        'due_date',
        'assigner_id'
    ];

    /**
     * Get the user that was given the task.
     */
    public function assignee()
    {
        return $this->belongsTo(Employee::class, 'assignee_id');
    }
    /**
     * Get the user that assigned the task.
     */
    public function assigner()
    {
        return $this->belongsTo(Employee::class, 'assigner_id');
    }

    public function files()
    {
        return $this->hasOne(TaskAttachment::class);
    }
}
