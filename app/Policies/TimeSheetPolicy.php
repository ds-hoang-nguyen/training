<?php

namespace App\Policies;

use App\Models\TimeSheet;
use App\Models\User;

class TimeSheetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, TimeSheet $timeSheet): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TimeSheet $timeSheet): bool
    {
        return $user->role == User::ADMIN || $user->role == User::MANAGER || $timeSheet->created_by == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TimeSheet $timeSheet): bool
    {
        return $user->role == User::ADMIN || $user->role == User::MANAGER || $timeSheet->created_by == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TimeSheet $timeSheet): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TimeSheet $timeSheet): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TimeSheet $timeSheet): bool
    {
        //
    }

    /**
     * Determine whether the user can export the model.
     */
    public function export(User $user): bool
    {
        return $user->role == User::ADMIN;
    }
}
