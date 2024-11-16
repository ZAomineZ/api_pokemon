<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Ability;
use App\Repositories\Contract\AbilityContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

final class AbilityRepository extends BaseRepository implements AbilityContract
{
    public function __construct(
        protected Ability $ability
    )
    {
        parent::__construct($this->ability);
    }

    public function findByNameEN(string $nameEN): ?Model
    {
        $ability = $this->model
            ->with(['pokemons' => function ($query) {
                $query
                    ->select('pokemons.id', 'pokemons.name_fr', 'pokemons.name_en');
            }])
            ->where('name_en', $nameEN)
            ->first();

        $ability->makeHidden('pokemons');
        $ability->pokemons->each(function ($generation) {
            $generation->makeHidden('moves_pokemon');
        });

        return $ability;
    }

    public function findAllWithPaginate(int $perPage, array $query = []): LengthAwarePaginator
    {
        $model = $this->model;

        if (!empty($query)) {
            if (isset($query['q'])) {
                $model = $model->where('name_en', 'like', '%' . $query['q'] . '%');
            }
        }

        return $model
            ->with('pokemons')
            ->paginate($perPage)
            ->through(function ($item) {
                return $item->makeHidden('pokemons');
            });
    }
}
