<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stats extends Model
{
    use HasFactory;

    protected $hidden = ['pivot', 'created_at', 'updated_at', 'pokemon_id', 'id'];

    protected $guarded = [];

    public function pokemon(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class);
    }
}
