<?php

declare(strict_types=1);

namespace App\Repositories\Contract;

use App\Models\Ability;
use App\Models\Move;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AbilityContract
{
    /**
     * Find resource.
     *
     * @param int $id
     * @return Ability|null
     */
    public function find(int $id): ?Model;

    /**
     * Find resource by name_en.
     *
     * @param string $nameEN
     * @return Model|null
     */
    public function findByNameEN(string $nameEN): ?Model;

    /**
     * Find all resources.
     *
     * @return Collection
     */
    public function findAll(): Collection;

    /**
     * Find all resources with paginate.
     *
     * @param int $perPage
     * @param array $query
     * @return LengthAwarePaginator
     */
    public function findAllWithPaginate(int $perPage, array $query = []): LengthAwarePaginator;

    /**
     * Create new resource.
     *
     * @param array $data
     * @return Ability
     */
    public function create(array $data): Model;

    /**
     * Update existing resource.
     *
     * @param int $id
     * @param array $data
     * @return Ability
     */
    public function update(int $id, array $data): Model;

    /**
     * Delete existing resource.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
