<?php

namespace App\Policies;

use App\Models\NewsDraf;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NewsDraftPolicy
{
        /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, NewsDraf $newsDraf): bool
    {
        return $user->id == $newsDraf->user_id;
    }

    public function update(User $user, NewsDraf $newsDraf): bool
    {
        return $user->id == $newsDraf->user_id;
    }



}
