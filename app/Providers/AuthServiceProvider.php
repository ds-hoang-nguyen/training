<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\TimeSheet;
use App\Models\User;
use App\Policies\TimeSheetPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => User::class,
        TimeSheet::class => TimeSheetPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
