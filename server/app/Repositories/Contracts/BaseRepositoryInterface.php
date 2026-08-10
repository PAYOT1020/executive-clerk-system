<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    public function all(): Collection;

    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function find(int $id): ?Model;

    public function findOrFail(int $id): Model;

    public function create(array $data): Model;

    public function update(Model $model, array $data): Model;

    public function delete(Model $model): bool;
}
