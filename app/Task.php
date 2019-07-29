<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Task
 *
 * @property int $id
 * @property int $assigned_to
 * @property string $task_name
 * @property string $description
 * @property string $statue
 * @property string $attach_file
 * @property string $deadline
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Task newModelQuery()
 * @method static Builder|Task newQuery()
 * @method static Builder|Task query()
 * @method static Builder|Task whereAssignedto($value)
 * @method static Builder|Task whereAttachfile($value)
 * @method static Builder|Task whereCreatedAt($value)
 * @method static Builder|Task whereDeadline($value)
 * @method static Builder|Task whereDescription($value)
 * @method static Builder|Task whereId($value)
 * @method static Builder|Task whereStatue($value)
 * @method static Builder|Task whereTaskname($value)
 * @method static Builder|Task whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Task extends Model
{
    protected $fillable = [
        'assigned_to', 'task_name', 'description', 'statue', 'attach_file', 'deadline',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
