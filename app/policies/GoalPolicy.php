<?php
namespace App\Policies;

use App\Models\Goal;
use App\Models\User;

class GoalPolicy
{
    public function delete(User $user, Goal $goal)
    {
        return $user->id === $goal->user_id;
    }
}
