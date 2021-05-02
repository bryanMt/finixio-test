<?php

namespace App\Console\Commands;

use App\Domain\Coin;
use App\Domain\CoinId;
use App\Repositories\CoinRepository;
use App\Services\CryptoCompareService;
use Illuminate\Console\Command;

class fetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crypto:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'retrieves the prices of the top 10 coins from the free cryptocompare API and persists to Redis';

    /**
     * @var CryptoCompareService
     */
    private CryptoCompareService $cryptoCompareService;
    private CoinRepository $coinRepository;

    /**
     * Create a new command instance.
     *
     * @param CryptoCompareService $service
     * @param CoinRepository $repository
     */
    public function __construct(CryptoCompareService $service, CoinRepository $repository)
    {
        parent::__construct();
        $this->cryptoCompareService = $service;
        $this->coinRepository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //retrieve top ten coins
        $coinsData = $this->cryptoCompareService->retrieveTopTenCoins();
        foreach ($coinsData as $coinData){
            $id = $this->coinRepository->generateId();
            $this->coinRepository->save(
                Coin::draft(
                    $id,
                    $coinData['name'],
                    $coinData['fullName'],
                    floatval($coinData['currentPrice']),
                    $coinData['lastRetrievedAt'],
                    $coinData['currentPriceFormatted'],
                    floatval($coinData['openingPrice']),
                    $coinData['openingPriceFormatted'],
                    floatval($coinData['priceIncrease']),
                    $coinData['priceIncreaseFormatted'],
                    floatval($coinData['priceIncreasePercentage']),
                    $coinData['priceIncreasePercentageFormatted']
                )
            );
        }

        $this->info("Top 10 coins saved successfully...");
    }

}
