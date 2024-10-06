<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;
use App\Models\UserTicket;

class UserTicketPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UserTicketView);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserTicket $userTicket): bool
    {
        if ($userTicket->user_id === auth()->user()->id)
            return true;
        if ($user->hasPermissionTo(PermissionEnum::UserTicketView))
            return true;

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserTicket $userTicket): bool
    {
        if ($userTicket->user_id === auth()->user()->id)
            return true;
        if ($user->hasPermissionTo(PermissionEnum::UserTicketUpdate))
            return true;

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserTicket $userTicket): bool
    {
        if ($userTicket->user_id === auth()->user()->id)
            return true;
        if ($user->hasPermissionTo(PermissionEnum::UserTicketDelete))
            return true;

        return false;
    }

    public function paid(User $user, UserTicket $userTicket): bool
    {
        if ($userTicket->user_id === auth()->user()->id)
            return true;
        if ($user->hasPermissionTo(PermissionEnum::UserTicketView))
            return true;

        return false;
    }
}
