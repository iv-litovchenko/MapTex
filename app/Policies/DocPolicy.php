<?php

namespace App\Policies;

use App\Models\Doc;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Doc $doc)
    {
        //
    }

    public function create(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function update(User $user, Doc $doc)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function delete(User $user, Doc $doc)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function restore(User $user, Doc $doc)
    {
        //
    }

    public function forceDelete(User $user, Doc $doc)
    {
        //
    }
}
