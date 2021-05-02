<?php

namespace Tests\Feature;

use App\Domain\Coin;
use App\Domain\CoinId;
use App\Repositories\CoinRepository;
use App\Repositories\FakeInMemoryPersistence;
use App\Repositories\InMemoryPersistence;
use OutOfBoundsException;
use Tests\TestCase;

class CoinRepositoryTest extends TestCase {

    private CoinRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CoinRepository(new FakeInMemoryPersistence());
    }

    public function testCanGenerateId()
    {
        $this->assertEquals(1, $this->repository->generateId()->toInt());
    }

    public function testThrowsExceptionWhenTryingToFindCoinWhichDoesNotExist()
    {
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('Coin with id 42 does not exist');

        $this->repository->findById(CoinId::fromInt(42));
    }

    public function testCanPersistPostDraft()
    {
        $coinId = $this->repository->generateId();
        $coin = Coin::draft($coinId, 'BTC', 'Bitcoin', 55.001231,'2021-04-21 10:11:56', '$10,610.98', 10600, '$10,600.00', 10.98, '$10.98', 0.104, '0.104%');
        $this->repository->save($coin);

        $this->repository->findById($coinId);

        $this->assertEquals($coinId, $this->repository->findById($coinId)->getId());
        $this->assertEquals('Bitcoin', $coin->getFullName());
    }

}
