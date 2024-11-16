<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\PokemonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PokemonController extends Controller
{
    public function __construct(
        protected PokemonService $pokemonService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 25);
        $query = $request->query();

        $pokemons = $this->pokemonService->getAllWithPaginate($perPage, $query);

        return response()->json($pokemons);
    }

    public function show(Request $request, string $name): JsonResponse
    {
        $pokemon = $this->pokemonService->getByName($name);

        return response()->json($pokemon);
    }
}
