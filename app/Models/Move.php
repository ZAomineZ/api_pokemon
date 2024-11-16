<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Move extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    protected $appends = ['move_pokemons'];

    public function pokemons(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class, 'move_pokemon', 'move_id', 'pokemon_id');
    }

    public function getMovePokemonsAttribute()
    {
        $pokemons = $this->pokemons;

        return $pokemons->map(function ($pokemon, $index) {
            return route('pokemons.show', [$pokemon->name_en]);
        })->toArray();
    }
}
