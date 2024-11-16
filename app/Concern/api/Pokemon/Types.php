<?php

declare(strict_types=1);

namespace App\Concern\api\Pokemon;

use Illuminate\Support\Facades\Http;

final class Types
{
    public function getTypes(): array
    {
        $response = Http::get(ApiURLS::POKE_API_URL . "/type");
        $responseJSON = $response->json() ?? [];

        $types = [];
        foreach ($responseJSON['results'] as $result)
        {
            $responseType = Http::get($result['url']);
            $responseTypeJSON = $responseType->json() ?? [];
            $namesType = $responseTypeJSON['names'];
            $types[] = [
                'nameFR' => current(array_filter($namesType, fn(array $item) => $item['language']['name'] === "fr"))['name'],
                'nameEN' => current(array_filter($namesType, fn(array $item) => $item['language']['name'] === "en"))['name']
            ];
        }

        return $types;
    }
}
