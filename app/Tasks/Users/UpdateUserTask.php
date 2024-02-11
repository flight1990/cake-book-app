<?php

namespace App\Tasks\Users;

use App\Repositories\Users\UserInterface;

class UpdateUserTask
{
    public function __construct(protected UserInterface $repository)
    {}

    public function run(array $payload, int $id): array
    {
        return $this->repository->update($payload, $id);
    }
}
