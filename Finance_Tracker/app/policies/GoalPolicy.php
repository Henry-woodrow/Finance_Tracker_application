<?php
namespace App\Policies;

use App\Models\Goal;
use App\Models\User;

class GoalPolicy
{
    public function delete(User $user, Goal $goal)
    {
        \Log::info('GoalPolicy check', [
            'user_id' => $user->id,
            'goal_user_id' => $goal->user_id,
            'match' => $user->id === $goal->user_id,
        ]);

        return $user->id === $goal->user_id;
    }
}
