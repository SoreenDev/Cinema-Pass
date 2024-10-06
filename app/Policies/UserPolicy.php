<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UserView);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        if ($model->id === auth()->user()->id)
            return true;
        if ($user->hasPermissionTo(PermissionEnum::UserView))
            return true;

        return false;
    }
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        if ($model->id === auth()->user()->id)
            return true;
        if ($user->hasPermissionTo(PermissionEnum::UserUpdate))
            return true;

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        if ($model->id === auth()->user()->id)
            return true;
        if ($user->hasPermissionTo(PermissionEnum::UserDelete))
            return true;

        return false;
    }
}
