<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Move;
use App\Repositories\Contract\MoveContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

final class MoveRepository extends BaseRepository implements MoveContract
{
    public function __construct(
        protected Move $move
    )
    {
        parent::__construct($this->move);
    }

    public function findByName(string $nameEN): ?Model
    {
        $move = $this->move
            ->with(['pokemons' => function ($query) {
                $query
                    ->select('pokemons.id', 'pokemons.name_fr', 'pokemons.name_en');
            }])
            ->where('name_en', $nameEN)
            ->first();

        $move->makeHidden('pokemons');
        $move->pokemons->each(function ($generation) {
            $generation->makeHidden('moves_pokemon');
        });

        return $move ?? null;
    }

    public function findAllWithPaginate(int $perPage, array $query = []): LengthAwarePaginator
        {
            $model = $this->move;

        if (!empty($query)) {
            if (isset($query['q'])) {
                $model = $model->where('name_en', 'like', '%' . $query['q'] . '%');
            }

            if (isset($query['accuracy'])) {
                $model = $model->where('accuracy', $query['accuracy']);
            }

            if (isset($query['power'])) {
                $model = $model->where('power', $query['power']);
            }

            if (isset($query['pp'])) {
                $model = $model->where('pp', $query['pp']);
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
