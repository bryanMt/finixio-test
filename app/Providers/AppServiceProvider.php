<?php

namespace App\Providers;

use App\Repositories\CoinRepository;
use App\Repositories\InMemoryPersistence;
use Cryptocompare\Toplists;
use Illuminate\Support\ServiceProvider;
use App\Services\CryptoCompareService;

class AppServiceProvider extends ServiceProvider
{
    //Can be moved to config file for easier maintainability...
    CONST API_KEY = '2708d573e82b89f1d3fc03184642f76deb32141734cebc8b780559875bd10f45';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //init library that parses the crypto compare api
        $topListsInstance = new TopLists(self::API_KEY);

        //inject the coin repository instance ...
        $this->app->bind('App\Repositories\CoinRepository', function (){
            return new CoinRepository(new InMemoryPersistence());
        });

        //inject the crypto compare library ...
        $this->app->bind('Cryptocompare\Toplists', function () use ($topListsInstance) {
            return $topListsInstance;
        });

        //inject the crypto compare service
        $this->app->bind('App\Services\CryptoCompareService', function () use ($topListsInstance){
            return new CryptoCompareService($topListsInstance);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
