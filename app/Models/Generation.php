<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Generation extends Model
{
    use HasFactory;

    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    protected $appends = ['generation_pokemons'];

    protected $guarded = [];

    public function pokemons(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class);
    }

    public function getGenerationPokemonsAttribute(): array
    {
        $pokemons = $this->pokemons;

        return $pokemons->map(function ($pokemon, $index) {
            return route('pokemons.show', [$pokemon->name_en]);
        })->toArray();
    }
}
