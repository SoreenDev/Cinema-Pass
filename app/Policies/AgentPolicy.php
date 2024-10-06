<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;

class AgentPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::AgentStore);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::AgentUpdate);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::AgentDelete);
    }
}
