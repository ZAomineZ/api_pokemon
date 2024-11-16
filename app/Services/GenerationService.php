<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Generation;
use App\Models\Pokemon;
use App\Repositories\GenerationRepository;
use App\Services\Contract\GenerationContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

final class GenerationService implements GenerationContract
{
    public function __construct(
        protected GenerationRepository $generationRepository
    )
    {}

    public function get(int $id): ?Generation
    {
        return $this->generationRepository->find($id);
    }

    public function getAll(): Collection
    {
        return $this->generationRepository->findAll();
    }

    public function create(array $data, Pokemon $pokemon): Generation
    {
        $generation = $this->generationRepository->create($data);

        $pokemon->generations()
            ->save($generation, ['generation_id' => $generation->id, 'pokemon_id' => $pokemon->id]);

        return $generation;
    }

    public function update(int $id, array $data = []): Generation
    {
        return $this->generationRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return  $this->generationRepository->delete($id);
    }

    public function getAllPaginated(int $perPage, array $query = []): LengthAwarePaginator
    {
        return $this->generationRepository->findAllWithPaginate($perPage, $query);
    }

    public function getByName(string $name): ?Generation
    {
        return $this->generationRepository->findByName($name);
    }
}
