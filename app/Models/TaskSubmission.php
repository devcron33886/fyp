<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskSubmission extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'task_submissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'task_id',
        'url',
        'notes',
        'submitted_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function submitted_by()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }
}
