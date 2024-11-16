<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\TypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TypeController extends Controller
{
    public function __construct(
        protected TypeService $typeService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 25);

        $query = $request->query();

        $types = $this->typeService->getAllPaginated($perPage, $query);

        return response()->json($types);
    }

    public function show(Request $request, string $name): JsonResponse
    {
        $type = $this->typeService->getByName($name);

        return response()->json($type);
    }
}
