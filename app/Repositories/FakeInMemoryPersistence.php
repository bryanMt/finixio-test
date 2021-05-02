<?php


namespace App\Repositories;


use App\Domain\Coin;
use Illuminate\Support\Facades\Redis;
use OutOfBoundsException;

class FakeInMemoryPersistence implements Persistence  {

    private int $lastId = 0;
    private array $data = [];

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
        $this->data[$this->lastId] = $data;
    }

    /**
     * @param int $id
     * @return array
     */
    public function retrieveById(int $id): array
    {
        if (!isset($this->data[$id])) {
            throw new OutOfBoundsException(sprintf('No data found for ID %d', $id));
        }

        return $this->data[$id];
    }

    /**
     * @return array
     */
    public function retrieveAll(): array {
        return $this->data;
    }

}
