<?php

namespace App\Services;
use App\Domain\Coin;
use App\Repositories\CoinRepository;
use App\Repositories\InMemoryPersistence;
use Cryptocompare\Toplists;
use Illuminate\Support\Facades\Log;


/**
 * Class CryptoCompareService
 * @package App\Services
 */
class CryptoCompareService {

    /**
     * Library to read crypo api (injected DI)
     * @var Toplists
     */
    private TopLists $topLists;

    /**
     * CryptoCompareService constructor.
     * @param Toplists $topLists
     */
    public function __construct(TopLists $topLists){
        $this->topLists = $topLists;
    }

    /**
     * Retrieves the top 10 coins
     */
    public function retrieveTopTenCoins() : array {
        $topCoins = [];
        //get the top list using a library
        $response = $this->topLists->getDataExchangeHistohour("USD", 0,false,  10);
        //Iterate on the response and persist the coins to memory
        foreach ($response->Data as $respData){
            $topCoins[] = [
                'name'                              => $respData->CoinInfo->Name,
                'fullName'                          => $respData->CoinInfo->FullName,
                'currentPrice'                      => $respData->RAW->USD->PRICE,
                'lastRetrievedAt'                   => date('Y-m-d H:i:s'),
                'currentPriceFormatted'             => 'TODO',
                'openingPrice'                      => 'TODO',
                'openingPriceFormatted'             => 'TODO',
                'priceIncrease'                     => 'TODO',
                'priceIncreaseFormatted'            => 'TODO',
                'priceIncreasePercentage'           => 'TODO',
                'priceIncreasePercentageFormatted'  => 'TODO',

            ];
        }
        Log::debug("Coins retrieved successfully from API ...");

        return $topCoins;
    }
}
