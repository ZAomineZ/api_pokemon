<?php

declare(strict_types=1);

namespace App\Repositories\Contract;

use App\Models\Pokemon;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TypeContract
{
    /**
     * Find resource.
     *
     * @param int $id
     * @return Pokemon|null
     */
    public function find(int $id): ?Model;

    /**
     * Find resource by name.
     *
     * @param string $name
     * @return Model|null
     */
    public function findByName(string $name): ?Model;

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
     * @return Post
     */
    public function create(array $data): Model;

    /**
     * Update existing resource.
     *
     * @param int $id
     * @param array $data
     * @return Post
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
