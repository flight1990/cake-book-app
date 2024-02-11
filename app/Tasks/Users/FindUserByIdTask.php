<?php

namespace App\Tasks\Users;

use App\Repositories\Users\UserInterface;

class FindUserByIdTask
{
    public function __construct(protected UserInterface $repository)
    {}

    public function run(int $id): array
    {
        return $this->repository->find($id);
    }
}
