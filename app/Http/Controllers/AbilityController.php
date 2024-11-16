<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AbilityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class AbilityController extends Controller
{
    public function __construct(
        protected AbilityService $abilityService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 25);

        $query = $request->query();

        $abilities = $this->abilityService->getAllPaginated($perPage, $query);

        return response()->json($abilities);
    }

    public function show(Request $request, string $name): JsonResponse
    {
        $ability = $this->abilityService->getByNameEN($name);

        return response()->json($ability);
    }
}
