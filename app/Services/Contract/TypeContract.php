<?php

declare(strict_types=1);

namespace App\Services\Contract;

use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Database\Eloquent\Collection;

interface TypeContract
{
    public function get(int $id): ?Type;

    public function getByName(string $name): ?Type;

    public function getAllPaginated(int $perPage, array $query = []);

    public function getAll(): Collection;

    public function create(array $data, Pokemon $pokemon): Type;

    public function update(int $id, array $data = []): Type;

    public function delete(int $id): bool;
}
