<?php

namespace App\Http\Controllers;

use App\Domain\CoinId;
use App\Repositories\CoinRepository;

class CoinController extends Controller  {

    /**
     * @var CoinRepository
     */
    private CoinRepository $repository;

    /**
     * CoinController constructor.
     * @param CoinRepository $coinRepository
     */
    public function __construct(CoinRepository $coinRepository) {
        $this->repository = $coinRepository;
    }

    /**
     * Get all coins
     */
    public function index() {
        return json_encode($this->repository->getAll());
    }

    /**
     * Get coin by id
     * @param $id
     * @return mixed
     */
    public function show($id) {
        return json_encode($this->repository->findById(CoinId::fromInt($id)));
    }

}
