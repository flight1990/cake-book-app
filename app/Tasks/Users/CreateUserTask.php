<?php

namespace App\Tasks\Users;

use App\Repositories\Users\UserInterface;

class CreateUserTask
{
    public function __construct(protected UserInterface $repository)
    {}

    public function run(array $payload): array
    {
        return $this->repository->create($payload);
    }
}
