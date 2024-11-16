<?php

declare(strict_types=1);

namespace App\Services\Contract;

use App\Models\Ability;
use App\Models\Move;
use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface AbilityContract
{
    public function get(int $id): ?Ability;

    public function getByNameEN(string $name_en): ?Ability;

    public function getAll(): Collection;

    public function getAllPaginated(int $perPage, array $query = []): LengthAwarePaginator;

    public function create(array $data, Pokemon $pokemon, ?Ability $abilityModel): Ability;

    public function update(int $id, array $data = []): Ability;

    public function delete(int $id): bool;
}
