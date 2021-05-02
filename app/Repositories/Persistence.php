<?php

namespace App\Repositories;

/**
 * Interface Persistence
 * @package App\Repositories
 */
interface Persistence {

    public function generateId(): int;

    public function persist(array $data);

    public function retrieveById(int $id): array;

    public function retrieveAll(): array;

}
