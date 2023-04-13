<?php

namespace App\Contracts\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserInterface
{

    /**
     * @param $filter
     * @return mixed
     */
    public function index(): Collection;

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * remove User.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
