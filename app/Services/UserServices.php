<?php
namespace App\Services;

use App\Transformers\BoardTransformer;
use App\Transformers\UserTransformer;
use App\User;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Auth;

class UserServices
{
    /** @var User */
    public $user;

    /** @var Manager $transformerManger */
    public $transformerManger;

    public function __construct(User $user, Manager $transformerManger)
    {
        $this->user              = $user;
        $this->transformerManger = $transformerManger;
    }

    public function create(array $data)
    {
        /* @var User $user */
        $data['password'] = bcrypt($data['password']);
        $user             = $this->user->create($data);

        $data          = new Item($user, new UserTransformer());
        $data          = $this->transformerManger->createData($data)->toArray();
        $data['token'] = $user->createToken('App')->accessToken;

        return $data;
    }

    public function getMyBoard()
    {
        /** @var User $user */
        $user = Auth::user();
        $data = new Collection($user->board()->get(), new BoardTransformer());

        return $this->transformerManger->createData($data)->toArray();
    }
}
