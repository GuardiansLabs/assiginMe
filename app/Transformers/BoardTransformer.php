<?php
namespace App\Transformers;

use App\Board;
use League\Fractal\TransformerAbstract;

class BoardTransformer extends TransformerAbstract
{
    public function transform(Board $board)
    {
        return [
            'id'    => (int) $board->id,
            'name'  => $board->name,
            'email' => $board->description,
        ];
    }
}
