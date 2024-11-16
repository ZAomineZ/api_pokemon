<?php

use App\Http\Controllers\AbilityController;
use App\Http\Controllers\GenerationController;
use App\Http\Controllers\MoveController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::get('/pokemons', [PokemonController::class, 'index'])
->name('pokemons.index');
Route::get('/pokemons/{name}', [PokemonController::class, 'show'])
->name('pokemons.show');

Route::get('/moves', [MoveController::class, 'index']);
Route::get('/moves/{name}', [MoveController::class, 'show'])
->name('moves.show');

Route::get('/types', [TypeController::class, 'index'])
->name('types.index');
Route::get('/types/{name}', [TypeController::class, 'show'])
->name('types.show');

Route::get('/abilities', [AbilityController::class, 'index'])
->name('abilities.index');
Route::get('/abilities/{name}', [AbilityController::class, 'show'])
->name('abilities.show');

Route::get('/generations', [GenerationController::class, 'index']);
Route::get('/generations/{name}', [GenerationController::class, 'show']);
