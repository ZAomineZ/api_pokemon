<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GenerationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class GenerationController extends Controller
{
    public function __construct(
        protected GenerationService $generationService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 25);
        $query = $request->query();

        $generations = $this->generationService->getAllPaginated($perPage, $query);

        return response()->json($generations);
    }

    public function show(Request $request, string $name): JsonResponse
    {
        $generation = $this->generationService->getByName($name);

        return response()->json($generation);
    }
}
