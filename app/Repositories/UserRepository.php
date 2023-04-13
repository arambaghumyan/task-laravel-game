<?php

namespace App\Repositories;

use App\Contracts\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    protected User $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(array $userData) : User
    {
       return $this->model->create($userData);
    }

}