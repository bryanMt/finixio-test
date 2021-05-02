<?php


namespace App\Repositories;


use App\Domain\Coin;
use Illuminate\Support\Facades\Redis;
use OutOfBoundsException;

class InMemoryPersistence implements Persistence  {

    private CONST HASHMAP_NAME = 'COINS';
    private int $lastId = 0;

    /**
     * @return int
     */
    public function generateId(): int
    {
        $this->lastId++;

        return $this->lastId;
    }

    /**
     * @param array $data
     */
    public function persist(array $data)
    {
        //save the id to the redis lookup set
        Redis::HSET(self::HASHMAP_NAME, $this->lastId, json_encode($data));

    }

    /**
     * @param int $id
     * @return array
     */
    public function retrieveById(int $id): array
    {
        $obj = Redis::HGET(self::HASHMAP_NAME, $id);

        if (!$obj) {
            throw new OutOfBoundsException(sprintf('No data found for ID %d', $id));
        }

        return json_decode($obj, true);
    }

    /**
     * @return array
     */
    public function retrieveAll(): array
    {
        $coins = [];
        $data = Redis::HVALS(self::HASHMAP_NAME);
        foreach ($data as $coin){
            $coins[] = json_decode($coin,true);
        }

        return $coins;
    }

}
