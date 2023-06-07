<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Update user
     * @return array
     */
    public function update(array $attributes)
    {
        if (isset($attributes['avatar'])) {
            $filePath = $attributes['avatar']->store('public/avatar');
            $userUpdate['avatar'] = $filePath;
        }

        if (isset($attributes['password'])) {
            $userUpdate['password'] = Hash::make($attributes['password']);
        }

        if (isset($attributes['description'])) {
            $userUpdate['description'] = $attributes['description'];
        }

        $user = User::query()->find($attributes['id']);
        if (!empty($userUpdate) && $user->update($userUpdate)) {
            return [
                'error' => false,
                'message' => __('message.Update success')
            ];
        }

        return [
            'error' => true,
            'message' => __('message.Update failed')
        ];
    }

    public function getUserByRole($role)
    {
        return $this->model->where('role', $role)->get();
    }
}
