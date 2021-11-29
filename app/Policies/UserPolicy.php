<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    
    public function create(User $user)
    {
        return $user->email === "jane@example.com";
    }

    public function edit(User $currentUser, User $user)
    {
        return (bool) mt_rand(0, 1);
    }
}