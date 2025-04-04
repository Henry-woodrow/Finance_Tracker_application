<?php
namespace App\Policies;

use App\Models\Goal;
use App\Models\User;

class GoalPolicy
{
    /**
     * Determine whether the user can delete the goal.
     */
    public function delete(User $user, Goal $goal)
    {
        return $user->id === $goal->user_id; // Allow only the owner to delete the goal
    }
}
