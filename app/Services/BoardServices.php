<?php
namespace App\Services;

use App\Board;
use App\Transformers\BoardTransformer;
use App\User;
use Auth;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class BoardServices
{
    /** @var Board */
    public $board;

    /** @var Manager $transformerManger */
    public $transformerManger;

    public function __construct(Board $board, Manager $transformerManger)
    {
        $this->board             = $board;
        $this->transformerManger = $transformerManger;
    }

    public function create(array $data)
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Board $board */
        $board = $user->board()->create($data);

        $data = new Item($board, new BoardTransformer());

        return $this->transformerManger->createData($data)->toArray();
    }

    public function getAll()
    {
        $data = new Collection($this->board->all(), new BoardTransformer());

        return $this->transformerManger->createData($data)->toArray();
    }
}
