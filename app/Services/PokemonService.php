<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Pokemon;
use App\Repositories\PokemonRepository;
use App\Services\Contract\PokemonContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class PokemonService implements PokemonContract
{
    public function __construct(
        protected PokemonRepository $pokemonRepository
    )
    {}

    public function get(int $id): ?Pokemon
    {
        return $this->pokemonRepository->find($id);
    }

    public function getAll(): Collection
    {
        return $this->pokemonRepository->findAll();
    }

    public function create(array $data = []): Pokemon
    {
        return $this->pokemonRepository->create($data);
    }

    public function update(int $id, array $data = []): Pokemon
    {
        return $this->pokemonRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->pokemonRepository->delete($id);
    }

    public function getAllWithPaginate(int $perPage, array $query): LengthAwarePaginator
    {
        return $this->pokemonRepository->findAllWithPaginate($perPage, $query);
    }

    public function getByName(string $name): ?Pokemon
    {
        return $this->pokemonRepository->findByName($name);
    }
}
