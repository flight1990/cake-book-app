<?php

namespace App\Actions\Users;

use App\Tasks\Users\FindUserByIdTask;

class FindUserByIdAction
{
    public function __construct(protected FindUserByIdTask $findUserByIdTask)
    {}

    public function run(int $id): array
    {
        return $this->findUserByIdTask->run($id);
    }
}
