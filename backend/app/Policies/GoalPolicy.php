<?php

namespace App\Policies;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return true; // Usuário logado pode ver a lista de suas metas
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Goal $goal)
    {
        return $user->id === $goal->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return true; // Usuário logado pode criar metas
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Goal $goal)
    {
        return $user->id === $goal->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Goal $goal)
    {
        return $user->id === $goal->user_id;
    }
}
