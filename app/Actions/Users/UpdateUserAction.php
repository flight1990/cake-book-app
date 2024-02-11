<?php

namespace App\Actions\Users;

use App\Tasks\Users\UpdateUserTask;
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
