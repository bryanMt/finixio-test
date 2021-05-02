<?php


namespace App\Domain;

use InvalidArgumentException;

class CoinId  {

    private int $id;

    /**
     *
     */
    public static function fromInt(int $id): CoinId
    {
        self::ensureIsValid($id);

        return new self($id);
    }

    /**
     * CoinId constructor.
     * @param int $id
     */
    private function __construct(int $id) {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function toInt(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    private static function ensureIsValid(int $id)
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid CoinId given');
        }
    }

}
