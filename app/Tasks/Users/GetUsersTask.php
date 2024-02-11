<?php

namespace App\Tasks\Users;

use App\Repositories\Users\UserInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GetUsersTask
{
    public function __construct(protected UserInterface $repository)
    {}

    public function run(array $params = []): LengthAwarePaginator
    {
        return $this->repository->paginate($params['limit'] ?? 10);
    }
}
