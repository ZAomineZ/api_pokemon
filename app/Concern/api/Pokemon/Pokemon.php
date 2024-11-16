<?php

declare(strict_types=1);

namespace App\Concern\api\Pokemon;

use Illuminate\Support\Facades\Http;

final class Pokemon
{
    public function get(string $pokemon): array
    {
        $pokemon = mb_strtolower($pokemon);

        $response = Http::get(ApiURLS::POKE_API_URL . "/pokemon/$pokemon");

        return $response->json() ?? [];
    }

    public function getAbility(string $pokemon): array
    {
        $response = Http::get(ApiURLS::POKE_API_URL . "/ability/$pokemon");

        return $response->json() ?? [];
    }

    public function getLanguage(int $id): array
    {
        $response = Http::get(ApiURLS::POKE_API_URL . "/language/$id");

        return $response->json() ?? [];
    }
}
