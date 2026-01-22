<?php

namespace App\Providers;

use App\Interfaces\BlogCategoryRepositoryInterface;
use App\Interfaces\BlogCommentRepositoryInterface;
use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\BlogTagRepositoryInterface;
use App\Interfaces\SystemSettingRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogCommentRepository;
use App\Repositories\BlogRepository;
use App\Repositories\BlogTagRepository;
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
            BlogCategoryRepositoryInterface::class,
            BlogCategoryRepository::class
        );

        $this->app->bind(
            BlogCommentRepositoryInterface::class,
            BlogCommentRepository::class
        );

        $this->app->bind(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );

        $this->app->bind(
            BlogTagRepositoryInterface::class,
            BlogTagRepository::class
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
