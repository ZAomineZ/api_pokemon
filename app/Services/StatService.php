<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Pokemon;
use App\Models\Stats;
use App\Models\Type;
use App\Repositories\StatRepository;
use App\Repositories\TypeRepository;
use App\Services\Contract\StatContract;
use App\Services\Contract\TypeContract;
use Illuminate\Database\Eloquent\Collection;

final class StatService implements StatContract
{
    public function __construct(
        protected StatRepository $statRepository
    ) {}

    public function get(int $id): ?Stats
    {
        return $this->statRepository->find($id);
    }

    public function getAll(): Collection
    {
        return $this->statRepository->findAll();
    }

    public function create(array $data, Pokemon $pokemon): Stats
    {
        return $this->statRepository
            ->create([...$data, 'pokemon_id' => $pokemon->id]);
    }

    public function update(int $id, array $data = []): Stats
    {
        return $this->statRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return  $this->statRepository->delete($id);
    }
}
