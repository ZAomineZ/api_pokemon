<?php

declare(strict_types=1);

namespace App\Services\Contract;

use App\Models\Generation;
use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Collection;

interface GenerationContract
{
    public function get(int $id): ?Generation;

    public function getByName(string $name): ?Generation;

    public function getAllPaginated(int $perPage, array $query = []);

    public function getAll(): Collection;

    public function create(array $data, Pokemon $pokemon): Generation;

    public function update(int $id, array $data = []): Generation;

    public function delete(int $id): bool;
}
