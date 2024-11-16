<?php

declare(strict_types=1);

namespace App\Services\Contract;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PokemonContract
{
    public function get(int $id): ?Pokemon;

    public function getByName(string $name): ?Pokemon;

    public function getAll(): Collection;

    public function getAllWithPaginate(int $perPage, array $query): LengthAwarePaginator;

    public function create(array $data = []): Pokemon;

    public function update(int $id, array $data = []): Pokemon;

    public function delete(int $id): bool;
}
