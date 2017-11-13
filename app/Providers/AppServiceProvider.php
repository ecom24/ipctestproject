<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Books\Repositories\Contracts\BookRepository as BookRepositoryInterface;
use App\Books\Repositories\BookDemoRepository;
use App\Services\Contracts\EntityManager as EntityManagerInterface;
use App\Services\DemoEntityManager;
use App\Books\Transformers\Contracts\BookTransformer as BookTransformerInterface;
use App\Books\Transformers\BookTransformer;
use App\Books\Services\Contracts\BookInputMapperService as BookInputMapperServiceInterface;
use App\Books\Services\BookInputMapperService;
use App\Book\Entities\Contracts\Book as BookInterface;
use App\Books\Entities\Book;
use App\Books\Services\BookFactory;
use App\Services\Contracts\BookFactory as BookFactoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EntityManagerInterface::class, DemoEntityManager::class);
        $this->app->singleton(BookRepositoryInterface::class, BookDemoRepository::class);
        $this->app->singleton(BookTransformerInterface::class, BookTransformer::class);
        $this->app->singleton(BookInputMapperServiceInterface::class, BookInputMapperService::class);
        $this->app->singleton(BookFactoryInterface::class, BookFactory::class);
    }
}
