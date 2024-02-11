<?php

namespace App\Tasks\Users;

use App\Repositories\Users\UserInterface;

class DeleteUserTask
{
    public function __construct(protected UserInterface $repository)
    {}

    public function run(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
