<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Move;
use App\Models\Pokemon;
use App\Repositories\MoveRepository;
use App\Services\Contract\MoveContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class MoveService implements MoveContract
{
    public function __construct(
        protected MoveRepository $moveRepository
    )
    {}

    public function get(int $id): ?Move
    {
        return $this->moveRepository->find($id);
    }

    public function getAll(): Collection
    {
        return $this->moveRepository->findAll();
    }

    public function create(array $data, Pokemon $pokemon, ?Move $moveModel = null): Move
    {
        if (!$moveModel) $move = $this->moveRepository->create($data);

        $pokemon->moves()->attach($move ?? $moveModel);

        return $move ?? $moveModel;
    }

    public function update(int $id, array $data = []): Move
    {
        return $this->moveRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->moveRepository->delete($id);
    }

    public function getByName(string $nameEN): ?Move
    {
        return $this->moveRepository->findByName($nameEN);
    }

    public function getAllPaginated(int $perPage, array $query = []): LengthAwarePaginator
    {
        return $this->moveRepository->findAllWithPaginate($perPage, $query);
    }
}
