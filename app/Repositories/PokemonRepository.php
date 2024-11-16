<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Pokemon;
use App\Repositories\Contract\PokemonContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

final class PokemonRepository extends BaseRepository implements PokemonContract
{
    public function __construct(
        protected Pokemon $pokemon
    )
    {
        parent::__construct($this->pokemon);
    }

    public function findAllWithPaginate(
        int $perPage,
        array $query = [],
    ): LengthAwarePaginator
    {
        $model = $this->pokemon
            ->select('id', 'number', 'name_fr', 'name_en', 'name_jap_kanji', 'name_jap', 'weight', 'height', 'base_experience', 'image', 'mega_evolution', 'legendary')
            ->with('generations', function ($query) {
                $query->select('name_fr', 'name_en');
            })
            ->with('abilities', function ($query) {
                $query
                    ->select('abilities.id', 'abilities.name_en', 'abilities.name_en', 'abilities.slug_fr', 'abilities.slug_en', 'abilities.content_en', 'abilities.content_short_en');
            })
            ->with('stat')
            ->with(['types' => function ($query) {
                $query->select('types.id', 'types.name_en', 'types.name_fr');
            }])
            ->with(['moves' => function ($query) {
                $query->select('moves.id as move_id', 'moves.name_en', 'move_pokemon.pokemon_id');
            }]);

        if (!empty($query)) {
            if (isset($query['q'])) {
                $model = $model->where('name_en', 'like', '%' . $query['q'] . '%');
            }

            if (isset($query['num'])) {
                $model = $model->where('number', $query['num']);
            }

            if (isset($query['base_experience'])) {
                $model = $model->where('base_experience', '>=', $query['base_experience']);
            }

            // Types relation
            if (isset($query['type'])) {
                $model = $model->whereHas('types', function ($queryModel) use ($query) {
                    $queryModel->where('name_en', $query['type']);
                });
            }
            // Abilities relation
            if (isset($query['ability'])) {
                $model = $model->whereHas('abilities', function ($queryModel) use ($query) {
                    $queryModel->where('name_en', $query['ability']);
                });
            }

            // Moves relation
            if (isset($query['move'])) {
                $model = $model->whereHas('moves', function ($queryModel) use ($query) {
                    $queryModel->where('name_en', $query['move']);
                });
            }

            // Generation relation
            if (isset($query['generation'])) {
                $model = $model->whereHas('generations', function ($queryModel) use ($query) {
                    $queryModel->where('name_en', $query['generation']);
                });
            }

            // Weight and height
            if (isset($query['weight'])) {
                $model = $model->where('weight', '>', $query['weight']);
            }

            if (isset($query['height'])) {
                $model = $model->where('height', '>', $query['height']);
            }

            // Stats
            if (isset($query['hp'])) {
                $model = $model->whereHas('stat', function ($queryModel) use ($query) {
                    $queryModel->where('hp', $query['hp']);
                });
            }

            if (isset($query['attack'])) {
                $model = $model->whereHas('stat', function ($queryModel) use ($query) {
                    $queryModel->where('attack', $query['attack']);
                });
            }

            if (isset($query['defense'])) {
                $model = $model->whereHas('stat', function ($queryModel) use ($query) {
                    $queryModel->where('defense', $query['defense']);
                });
            }

            if (isset($query['special_attack'])) {
                $model = $model->whereHas('stat', function ($queryModel) use ($query) {
                    $queryModel->where('special_attack', $query['special_attack']);
                });
            }

            if (isset($query['special_defense'])) {
                $model = $model->whereHas('stat', function ($queryModel) use ($query) {
                    $queryModel->where('special_defense', $query['special_defense']);
                });
            }

            if (isset($query['speed'])) {
                $model = $model->whereHas('stat', function ($queryModel) use ($query) {
                    $queryModel->where('speed', $query['speed']);
                });
            }

            if (isset($query['legendary'])) {
                $model = $model->where('legendary', $query['legendary']);
            }

            if (isset($query['mega_evolution'])) {
                $model = $model->where('mega_evolution', $query['mega_evolution']);
            }
        }

        return $model
            ->paginate($perPage)
            ->through(function ($item) {
                $item->generations
                    ->makeHidden(['pokemons', 'generation_pokemons']);
                $item->abilities
                    ->makeHidden('ability_pokemons');
                $item->types
                    ->makeHidden('type_pokemons');
                $item->moves
                    ->makeHidden('move_pokemons');
                return $item->makeHidden('moves');
            });
    }

    public function findByName(string $name): ?Model
    {
        $pokemon = $this->pokemon
            ->select('id', 'number', 'name_fr', 'name_en', 'name_jap_kanji', 'name_jap', 'weight', 'height', 'base_experience', 'image', 'mega_evolution', 'legendary')
            ->with('generations', function ($query) {
                $query->select('name_fr', 'name_en');
            })
            ->with('abilities')
            ->with('stat')
            ->with(['types' => function ($query) {
                $query->select('types.id', 'types.name_en', 'types.name_fr');
            }])
            ->with(['moves' => function ($query) {
                $query->select('moves.id as move_id', 'moves.name_en', 'move_pokemon.pokemon_id');
            }])
            ->where(function($query) use ($name) {
                $query->where('name_en', $name)
                    ->orWhere('name_fr', $name);
            })
            ->first();

        $pokemon->generations->each(function ($generation) {
            $generation->makeHidden('generation_pokemons');
        });

        $pokemon->abilities->each(function ($generation) {
            $generation->makeHidden('ability_pokemons');
        });

        $pokemon->types->each(function ($generation) {
            $generation->makeHidden('type_pokemons');
        });

        $pokemon->moves->each(function ($generation) {
            $generation->makeHidden('move_pokemons');
        });

        return $pokemon;
    }
}
