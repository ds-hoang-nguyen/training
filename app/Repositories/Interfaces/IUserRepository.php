<?php

namespace App\Repositories\Interfaces;

interface IUserRepository
{
    public function update(array $attributes);

    public function getUserByRole($role);
}
