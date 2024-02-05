<?php

namespace App\Tasks;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UpdateUserTask
{
    public function __construct(protected User $model)
    {}

    public function run(array $params, int $id): bool
    {
        $user = $this->model->findOrFail($id);

        return $user->update($params);
    }
}
