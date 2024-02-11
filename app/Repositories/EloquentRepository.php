<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class EloquentRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->mapCollection($this->model->all());
    }

    public function paginate($limit = 15): LengthAwarePaginator
    {
        $paginator = $this->model->paginate($limit);
        $items = $this->mapCollection($paginator->items());

        return new LengthAwarePaginator(
            $items,
            $paginator->total(),
            $paginator->perPage(),
            $paginator->currentPage(),
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }

    public function find(int $id): array
    {
        return $this->model->findOrFail($id)->toArray();
    }

    public function create(array $payload): array
    {
        return $this->model->create($payload)->toArray();
    }

    public function update(array $payload, int $id): array
    {
        $model = $this->model->findOrFail($id);
        $model->update($payload);

        return $model->toArray();
    }

    public function delete(int $id): bool
    {
        $model = $this->model->findOrFail($id);
        return $model->delete();
    }

    protected function mapCollection($items): Collection
    {
        return $items instanceof Collection ? $items->map(function ($item) {
            return $item->toArray();
        }) : collect($items)->map(function ($item) {
            return $item->toArray();
        });
    }
}
