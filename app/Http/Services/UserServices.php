<?php
namespace App\Http\Services;

use App\Http\Controllers\Controller;
use App\User;

class UserServices extends Controller
{
    /** @var User */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(array $data): User
    {
        /** @var User $user */
        $user          = $this->user->create($data);
        $user['token'] = $user->createToken('App')->accessToken;

        return $user;
    }
}
