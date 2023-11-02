<?php

namespace App\Providers;

use App\Repository\BookingRepositoryInterface;
use App\Repository\Eloquent\BookingRepository;
use App\Repository\ReportRepositoryInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Repository\BaseRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\FilmRepositoryInterface;
use App\Repository\Eloquent\FilmRepository;
use App\Repository\Eloquent\HallRepository;
use App\Repository\Eloquent\ReportRepository;
use App\Repository\HallRepositoryInterface;
use App\Repository\TicketRepositoryInterface;
use App\Repository\Eloquent\TicketRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(FilmRepositoryInterface::class, FilmRepository::class);
        $this->app->bind(HallRepositoryInterface::class, HallRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::pattern('id', '[0-9]+');
        Route::pattern('title', '[A-Za-z0-9-]+');
        Route::pattern('name', '[A-Za-z0-9-]+');
        Route::pattern('coming-soon', '[coming-s]+');
    }
}
