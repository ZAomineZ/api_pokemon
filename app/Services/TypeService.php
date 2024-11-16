<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Pokemon;
use App\Models\Type;
use App\Repositories\TypeRepository;
use App\Services\Contract\TypeContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

final class TypeService implements TypeContract
{
    public function __construct(
        protected TypeRepository $typeRepository
    )
    {}

    public function get(int $id): ?Type
    {
        return $this->typeRepository->find($id);
    }

    public function getAll(): Collection
    {
        return $this->typeRepository->findAll();
    }

    public function create(array $data, Pokemon $pokemon): Type
    {
        $type = $this->typeRepository->create($data);

        $pokemon->types()
            ->save($type, ['type_id' => $type->id, 'pokemon_id' => $pokemon->id]);

        return $type;
    }

    public function update(int $id, array $data = []): Type
    {
        return $this->typeRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return  $this->typeRepository->delete($id);
    }

    public function getAllPaginated(int $perPage, array $query = []): LengthAwarePaginator
    {
        return $this->typeRepository->findAllWithPaginate($perPage, $query);
    }

    public function getByName(string $name): ?Type
    {
        return $this->typeRepository->findByName($name);
    }
}
