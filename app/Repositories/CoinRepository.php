<?php


namespace App\Repositories;

use App\Domain\Coin;
use App\Domain\CoinId;
use OutOfBoundsException;

/**
 * This class is situated between Entity layer (class Coin) and access object layer (Persistence).
 *
 * Repository encapsulates the set of objects persisted in a data store and the operations performed over them
 * providing a more object-oriented view of the persistence layer
 *
 * Repository also supports the objective of achieving a clean separation and one-way dependency
 * between the domain and data mapping layers
 */
class CoinRepository {

    private Persistence $persistence;

    /**
     * CoinRepository constructor.
     * @param Persistence $persistence
     */
    public function __construct(Persistence $persistence) {
        $this->persistence = $persistence;
    }

    /**
     * @return CoinId
     */
    public function generateId(): CoinId {
        return CoinId::fromInt($this->persistence->generateId());
    }

    /**
     * @param CoinId $id
     * @return Coin
     */
    public function findById(CoinId $id): Coin {
        try {
            $arrayData = $this->persistence->retrieveById($id->toInt());
        } catch (OutOfBoundsException $e) {
            throw new OutOfBoundsException(sprintf('Coin with id %d does not exist', $id->toInt()), 0, $e);
        }

        return Coin::fromState($arrayData);
    }

    /**
     * @return array
     */
    public function getAll(): array {
        $coins = [];
        $coinsData = $this->persistence->retrieveAll();
        foreach ($coinsData as $coinData ){
            $coins[] = Coin::fromState($coinData);
        }

        return $coins;
    }

    /**
     * @param Coin $coin
     */
    public function save(Coin $coin) {
        //DTO's
        $this->persistence->persist([
            'id'                                => $coin->getId()->toInt(),
            'name'                              => $coin->getName(),
            'fullName'                          => $coin->getFullName(),
            'currentPrice'                      => $coin->getCurrentPrice(),
            'lastRetrievedAt'                   => $coin->getLastRetrievedAt(),
            'currentPriceFormatted'             => $coin->getCurrentPriceFormatted(),
            'openingPrice'                      => $coin->getOpeningPrice(),
            'openingPriceFormatted'             => $coin->getOpeningPriceFormatted(),
            'priceIncrease'                     => $coin->getPriceIncrease(),
            'priceIncreaseFormatted'            => $coin->getPriceIncreaseFormatted(),
            'priceIncreasePercentage'           => $coin->getPriceIncreasePercentage(),
            'priceIncreasePercentageFormatted'  => $coin->getPriceIncreasePercentageFormatted()
        ]);
    }

}
