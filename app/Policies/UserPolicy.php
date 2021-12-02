<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    
    public function create(User $user)
    {
        return $user->hasPermissionTo('add users');
    }

    public function edit(User $user)
    {
        return $user->hasPermissionTo('edit users');
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo('delete users');
    }

    public function assignRoles(User $user)
    {
        return $user->hasPermissionTo('assign roles');
    }
}