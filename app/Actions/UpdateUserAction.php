<?php

namespace App\Actions;

use App\Tasks\UpdateUserTask;
use Illuminate\Support\Arr;

class UpdateUserAction
{
    public function __construct(protected UpdateUserTask $updateUserTask)
    {}

    public function run(array $payload, int $id): array
    {
        $payload = Arr::whereNotNull($payload);

        return $this->updateUserTask->run($payload, $id);
    }
}
