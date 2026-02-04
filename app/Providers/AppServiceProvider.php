<?php

namespace App\Providers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Interfaces\SystemSettingRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\BlogRepository;
use App\Repositories\TagRepository;
use App\Repositories\SystemSettingRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );

        $this->app->bind(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );

        $this->app->bind(
            TagRepositoryInterface::class,
            TagRepository::class
        );

        $this->app->bind(
            SystemSettingRepositoryInterface::class,
            SystemSettingRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
