<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Type extends Model
{
    use HasFactory;

    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    protected $appends = ['type_pokemons'];

    protected $guarded = [];

    public function pokemons(): MorphToMany
    {
        return $this->morphedByMany(Pokemon::class, 'typeable');
    }

    public function getTypePokemonsAttribute()
    {
        $pokemons = $this->pokemons;

        return $pokemons->map(function ($pokemon, $index) {
            return route('pokemons.show', [$pokemon->name_en]);
        })->toArray();
    }
}
