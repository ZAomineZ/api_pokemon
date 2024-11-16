<?php

declare(strict_types=1);

namespace App\Services\Contract;

use App\Models\Move;
use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface MoveContract
{
    public function get(int $id): ?Move;

    public function getByName(string $nameEN): ?Move;

    public function getAll(): Collection;

    public function getAllPaginated(int $perPage, array $query = []): LengthAwarePaginator;

    public function create(array $data, Pokemon $pokemon, ?Move $moveModel = null): Move;

    public function update(int $id, array $data = []): Move;

    public function delete(int $id): bool;
}
