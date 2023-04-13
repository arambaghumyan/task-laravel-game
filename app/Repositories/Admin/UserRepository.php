<?php

namespace App\Repositories\Admin;

use App\Contracts\Admin\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserInterface
{
    /**
     * @var User
     */
    protected User $model;

    /**
     * UserRepository constructor.
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function index(): Collection
    {
        return $this->model->with('token')->orderByDesc('created_at')->get();
    }

    public function store(array $data) : User
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data) : bool
    {
        return $this->model->where('id', $id)->update($data);
    }

    /**
     * @param int $id
     * @return bool|void
     */
    public function delete(int $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }
}
