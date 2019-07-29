<?php
namespace App;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\Client;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;

/**
 * An Eloquent Model: 'User'.
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property array $fillable
 *
 * @method static EloquentBuilder create(array $data)
 *
 * @property string|null $remember_token
 * @property Client[]|Collection $clients
 * @property DatabaseNotification[]|DatabaseNotificationCollection $notifications
 * @property Collection|Task[] $task
 * @property Board[]|Collection $board
 * @property Collection|Token[] $tokens
 *
 * @method static EloquentBuilder|User newModelQuery()
 * @method static EloquentBuilder|User newQuery()
 * @method static EloquentBuilder|User query()
 * @method static EloquentBuilder|User whereCreatedAt($value)
 * @method static EloquentBuilder|User whereEmail($value)
 * @method static EloquentBuilder|User whereId($value)
 * @method static EloquentBuilder|User whereName($value)
 * @method static EloquentBuilder|User wherePassword($value)
 * @method static EloquentBuilder|User whereRememberToken($value)
 * @method static EloquentBuilder|User whereUpdatedAt($value)
 * @method static HasApiTokens|User createToken($value)
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function board()
    {
        return $this->hasMany(Board::class);
    }
}
