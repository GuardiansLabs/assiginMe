<?php
namespace App;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Task.
 *
 * @property int $id
 * @property int $name
 * @property string $description
 * @property string $statue
 * @property string $attach_file
 * @property string $deadline
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 *
 * @method static Builder|Board newModelQuery()
 * @method static Builder|Board newQuery()
 * @method static Builder|Board query()
 * @method static Builder|Board whereCreatedAt($value)
 * @method static Builder|Board whereDescription($value)
 * @method static Builder|Board whereId($value)
 * @method static Builder|Board whereUserId($value)
 * @method static Builder|Board whereName($value)
 * @method static Builder|Board whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Board extends Model
{
    protected $fillable = [
        'name', 'user_id', 'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
