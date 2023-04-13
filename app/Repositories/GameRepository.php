<?php

namespace App\Repositories;

use App\Contracts\GameInterface;
use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;

class GameRepository implements GameInterface
{

    private Game $model;

    /**
     * @param Game $game
     */
    public function __construct(Game $game)
    {

        $this->model = $game;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): Game
    {
        return $this->model->create($data);
    }

    /**
     * @param int $tokenId
     * @param int $take
     * @return mixed
     */
    public function getLastResults(int $tokenId, int $take = 3): Collection
    {
        return $this->model->where('token_id', $tokenId)
            ->take($take)
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): Game
    {
        return $this->model->where('id', $id)->first();
    }
}
