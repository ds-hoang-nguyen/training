<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\IBaseRepository;
use App\Repositories\Interfaces\ITaskRepository;
use App\Repositories\Interfaces\ITimeSheetRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\TaskRepository;
use App\Repositories\TimeSheetRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $applicationRepositoryInterface = [
        IBaseRepository::class => BaseRepository::class,
        IUserRepository::class => UserRepository::class,
        ITimeSheetRepository::class => TimeSheetRepository::class,
        ITaskRepository::class => TaskRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->applicationRepositoryInterface as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
