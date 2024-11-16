<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Pokemon extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'pokemons';

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['moves_pokemon'];

    public function types(): MorphToMany
    {
        return $this->morphToMany(Type::class, 'typeable');
    }

    public function stat(): HasOne
    {
        return $this->hasOne(Stats::class);
    }

    public function moves(): BelongsToMany
    {
        return $this->belongsToMany(Move::class);
    }

    public function generations(): BelongsToMany
    {
        return $this->belongsToMany(Generation::class);
    }

    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(Ability::class);
    }

    public function getMovesPokemonAttribute(): array
    {
        $moves = $this->moves;

        return $moves->map(function ($move, $index) {
            return route('moves.show', [$move->name_en]);
        })->toArray();
    }
}
