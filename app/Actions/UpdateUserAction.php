<?php

namespace App\Actions;

use App\Tasks\UpdateUserTask;
use Illuminate\Support\Arr;

class UpdateUserAction
{
    public function __construct(protected UpdateUserTask $updateUserTask)
    {}

    public function run(array $params, int $id): bool
    {
        return $this->updateUserTask->run(Arr::whereNotNull($params), $id);
    }
}
