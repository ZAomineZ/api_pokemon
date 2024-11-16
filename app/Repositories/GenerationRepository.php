<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Generation;
use App\Repositories\Contract\TypeContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

final class GenerationRepository extends BaseRepository implements TypeContract
{
    public function __construct(
        protected Generation $generation
    )
    {
        parent::__construct($this->generation);
    }

    public function findAllWithPaginate(int $perPage, array $query = []): LengthAwarePaginator
    {
        $model = $this->generation;

        if (!empty($query)) {
            if (isset($query['q'])) {
                $model = $model->where('name_en', 'like', '%' . $query['q'] . '%');
            }
        }

        return $model
            ->with('pokemons') // Charge la relation
            ->paginate($perPage)
            ->through(function ($item) {
                return $item->makeHidden('pokemons'); // Cache la relation dans le JSON
            });
    }

    public function findByName(string $name): ?Model
    {
        $model = $this->generation
            ->with(['pokemons' => function ($query) {
                $query
                    ->select('pokemons.id', 'pokemons.name_fr', 'pokemons.name_en');
            }])
            ->where(function($query) use ($name) {
                $query->where('name_en', $name)
                    ->orWhere('name_fr', $name);
            })
            ->first();

        $model->makeHidden('pokemons');
        $model->pokemons->each(function ($generation) {
            $generation->makeHidden('moves_pokemon');
        });

        return $model;
    }
}
