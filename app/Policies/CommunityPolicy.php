<?php

namespace App\Policies;

use App\Models\Community;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any communities.
     */
    public function viewAny(User $user)
    {
        return true; // Semua pengguna dapat melihat komunitas
    }

    /**
     * Determine whether the user can view the community.
     */
    public function view(User $user, Community $community)
    {
        return true; // Semua pengguna dapat melihat komunitas
    }

    /**
     * Determine whether the user can create communities.
     */
    public function create(User $user)
    {
        return $user->hasRole('admin'); // Hanya admin yang dapat membuat komunitas
    }

    /**
     * Determine whether the user can update the community.
     */
    public function update(User $user, Community $community)
    {
        return $user->hasRole('admin'); // Hanya admin yang dapat mengubah komunitas
    }

    /**
     * Determine whether the user can delete the community.
     */
    public function delete(User $user, Community $community)
    {
        return $user->hasRole('admin'); // Hanya admin yang dapat menghapus komunitas
    }
}
