<?php

namespace App\Actions\Users;

use App\Tasks\Users\CreateUserTask;
use Illuminate\Support\Arr;

class CreateUserAction
{
    public function __construct(protected CreateUserTask $createUserTask)
    {}

    public function run(array $payload): array
    {
        $payload = Arr::whereNotNull($payload);

        return $this->createUserTask->run($payload);
    }
}
