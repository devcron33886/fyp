<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'teams';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'supervisor_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope('my-team', function (Builder $builder) {
            $user = Auth::user();

            if ($user) {
                $builder->where(function ($query) use ($user) {
                    $query->where('supervisor_id', $user->id)
                        ->orWhereHas('users', function ($q) use ($user) {
                            $q->where('users.id', $user->id);
                        });
                });
            }
        });
    }
}
