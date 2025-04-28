<?php
namespace App\Policies;

use App\Models\goal;
use App\Models\User;

class GoalPolicy
{
    /**
     * Determine whether the user can delete the goal.
     */
    public function delete(User $user, goal $goal)
    {
        \Log::info('Checking delete authorization', [
            'user_id' => $user->id,
            'goal_user_id' => $goal->user_id,
        ]);
        return $user->id === $goal->user_id; // Allow only the owner to delete the goal
    }
}
