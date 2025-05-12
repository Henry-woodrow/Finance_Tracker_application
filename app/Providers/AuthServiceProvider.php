<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Goal;
use App\Policies\GoalPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Goal::class => GoalPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
