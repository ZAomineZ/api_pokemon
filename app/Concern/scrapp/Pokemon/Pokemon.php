<?php

namespace App\Concern\scrapp\Pokemon;

use App\Concern\api\Pokemon\ApiURLS;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

final class Pokemon
{
    public function __construct(
        protected HttpBrowser $client
    ) {}

    /**
     */
    public function listPokemons(): array
    {
        $crawler = $this->client->request('GET', ApiURLS::POKE_URL_POKEDEX);

        $pokemons = $crawler
            ->filter('.tableaustandard.sortable.entetefixe tbody tr')
            ->each(function (Crawler $node) {
                $countTD = $node->filter('td')->count();

                $labelNameFR = "td:nth-child(3) a";
                if ($countTD === 7) $labelNameFR = "td:nth-child(2) a";

                $labelNameEN = "td:nth-child(4) a";
                if ($countTD === 7) $labelNameEN = "td:nth-child(3) a";

                $pokemonFR = $node->filter($labelNameFR)->text();
                $pokemonEN = $node->filter($labelNameEN)->text();

                $number = $node->filter("td:nth-child(1)")->text();

                return [
                    'name_fr' => empty($pokemonFR) ? $pokemonEN : $pokemonFR,
                    'number' => $number,
                    'name_en' => $pokemonEN
                ];
            });

        // Remove duplicates based on "name_fr"
        $uniquePokemons = [];
        foreach ($pokemons as $pokemon) {
            $uniquePokemons[$pokemon['name_fr']] = $pokemon;
        }

        return $uniquePokemons;
    }
}
