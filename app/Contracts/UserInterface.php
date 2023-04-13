<?php

namespace App\Contracts;

use App\Models\User;

interface UserInterface
{
    public function store(array $storeUserData) : User;
}