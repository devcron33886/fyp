<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'tasks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'pending' => 'Pending',
        'completed' => 'Completed',
    ];

    protected $fillable = [
        'title',
        'project_id',
        'team_id',
        'assigned_to_id',
        'supervisor_id',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope('my-task', function (Builder $builder) {
            $user = Auth::user();

            if ($user) {
                $builder->where(function ($query) use ($user) {
                    $query->where('supervisor_id', $user->id)
                          ->orWhereHas('team.users', function ($q) use ($user) {  // Corrected this line
                              $q->where('users.id', $user->id);
                          });
                });
            }
        });
    }
}
