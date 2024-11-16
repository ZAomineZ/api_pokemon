<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ability extends Model
{
    use HasFactory;

    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    protected $guarded = [];

    protected $appends = ['ability_pokemons'];

    public function pokemons(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class);
    }

    public function getAbilityPokemonsAttribute()
    {
        $pokemons = $this->pokemons;

        return $pokemons->map(function ($pokemon, $index) {
            return route('pokemons.show', [$pokemon->name_en]);
        })->toArray();
    }
}
