<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\MoveService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class MoveController extends Controller
{
    public function __construct(
        protected MoveService $moveService
    )
    {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 25);

        $query = $request->query();

        $moves = $this->moveService->getAllPaginated($perPage, $query);

        return response()->json($moves);
    }

    public function show(Request $request, string $name): JsonResponse
    {
        $move = $this->moveService->getByName($name);

        return response()->json($move);
    }
}
