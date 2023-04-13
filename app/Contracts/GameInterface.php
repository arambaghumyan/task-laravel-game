<?php

namespace App\Contracts;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;

interface GameInterface
{

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): Game;

    /**
     * @param int $tokenId
     * @param int $take
     * @return mixed
     */
    public function getLastResults(int $tokenId, int $take = 3): Collection;

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): Game;
}
