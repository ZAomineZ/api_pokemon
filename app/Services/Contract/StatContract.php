<?php

declare(strict_types=1);

namespace App\Services\Contract;

use App\Models\Pokemon;
use App\Models\Stats;
use App\Models\Type;
use Illuminate\Database\Eloquent\Collection;

interface StatContract
{
    public function get(int $id): ?Stats;

    public function getAll(): Collection;

    public function create(array $data, Pokemon $pokemon): Stats;

    public function update(int $id, array $data = []): Stats;

    public function delete(int $id): bool;
}
