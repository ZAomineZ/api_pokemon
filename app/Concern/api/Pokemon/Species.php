<?php

declare(strict_types=1);

namespace App\Concern\api\Pokemon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

final class Species
{
    public function getSpecies(string $pokemon) {
        $response = Http::get(ApiURLS::POKE_API_URL . "/pokemon-species/$pokemon");

        return $response->json() ?? [];
    }

    public function getAllSpecies(): array
    {
        $response = Http::get(ApiURLS::POKE_API_URL . "/pokemon-species");
        $responseJSON = $response->json() ?? [];

        $countPokemon = $responseJSON['count'];
        $species = [];

        for ($i = 1; $i <= $countPokemon; $i++) {
            $responseSpecie = Http::get(ApiURLS::POKE_API_URL . "/pokemon-species/$i/");
            $responseSpecieJSON = $responseSpecie->json() ?? [];

            $genera = $responseSpecieJSON['genera'];

            $generaFR = current(array_filter($genera, fn(array $item) => $item['language']['name'] === "fr"))['genus'];
            $generaEN = current(array_filter($genera, fn(array $item) => $item['language']['name'] === "en"))['genus'];

            $generaFR = Str::replace('Pokémon ', '', $generaFR);
            $generaFR = Str::replace('’', "'", $generaFR);
            $generaEN = Str::replace(' Pokémon', '', $generaEN);

            if (!in_array($generaFR, array_column($species, 'nameFR'))) {
                $species[] = ['nameFR' => $generaFR, 'nameEN' => $generaEN];
            }
        }

        return $species;
    }
}
