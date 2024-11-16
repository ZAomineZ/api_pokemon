<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ability;
use App\Models\Pokemon;
use App\Repositories\AbilityRepository;
use App\Services\Contract\AbilityContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class AbilityService implements AbilityContract
{
    public function __construct(
        protected AbilityRepository $abilityRepository
    ) {}

    public function get(int $id): ?Ability
    {
        return $this->abilityRepository->find($id);
    }

    public function getAll(): Collection
    {
        return $this->abilityRepository->findAll();
    }

    public function create(array $data, Pokemon $pokemon, ?Ability $abilityModel = null): Ability
    {
        if (!$abilityModel) $ability = $this->abilityRepository->create($data);

        $pokemon->abilities()->save($ability ?? $abilityModel);

        return $ability ?? $abilityModel;
    }

    public function update(int $id, array $data = []): Ability
    {
        return $this->abilityRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return  $this->abilityRepository->delete($id);
    }

    public function getByNameEN(string $name_en): ?Ability
    {
        return $this->abilityRepository->findByNameEN($name_en);
    }

    public function getAllPaginated(int $perPage, array $query = []): LengthAwarePaginator
    {
        return $this->abilityRepository->findAllWithPaginate($perPage, $query);
    }
}
