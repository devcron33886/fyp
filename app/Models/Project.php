<?php
namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'projects';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'proposal' => 'Proposal',
        'accepted' => 'Accepted',
        'progress' => 'In Progress',
        'completed' => 'Completed',
    ];

    protected $fillable = [
        'title',
        'description',
        'supervisor_id',
        'status',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope('my-project', function (Builder $builder) {
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
