<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;

class DailyScreeningsPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DailyScreeningStore);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DailyScreeningUpdate);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DailyScreeningDelete);
    }
}
