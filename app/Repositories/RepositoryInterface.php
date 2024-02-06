<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function all(): Collection;

    public function paginate($limit = 15): LengthAwarePaginator;

    public function find(int $id): array;

    public function create(array $payload): array;

    public function update(array $payload, int $id): array;

    public function delete(int $id): bool;
}
