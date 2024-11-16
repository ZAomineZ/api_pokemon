<?php

declare(strict_types=1);

namespace App\Concern\scrapp\Pokemon;

use App\Concern\api\Pokemon\ApiURLS;
use App\Concern\scrapp\Pokemon\traits\NameTranslate;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\BrowserKit\HttpBrowser;

final class Tags
{
    use NameTranslate;

    protected const LEGENDARY_FR = "Pokémon légendaire";

    public function __construct(
        protected HttpBrowser $client
    ) {}

    public function tags(array $pokemons = []): array
    {
        $tags = [];

        foreach ($pokemons as $pokemon) {
            $nameFR = $pokemon['name_fr'];
            $crawler = $this->client->request('GET', ApiURLS::POKE_URL . $nameFR);

            $cellsTable = $crawler
                ->filter('.smwfact .smw-table.smwfacttable .smw-table-row')
                ->each(function (Crawler $node) {
                    try {
                        $name = $node
                            ->filter('.smw-table-cell.smwpropname a')
                            ->text();
                    } catch (InvalidArgumentException $exception) {
                        $name = null;
                    }
                    try {
                        $value = $node
                            ->filter('.smw-table-cell.smwprops')
                            ->text();
                    } catch (InvalidArgumentException $exception) {
                        $value = null;
                    }

                    if (null === $name || null === $value) {
                        return [];
                    }

                    $value = Str::replace('+', '', $value);
                    return ['name' => $name, 'value' => trim($value)];
                });
            $cellsTable = array_values(array_filter($cellsTable));

            $dataCategoryPokemon = array_filter($cellsTable, fn(array $data) => $data['name'] === 'Catégorie du Pokémon');
            $dataGenerationPokemon = array_filter($cellsTable, fn(array $data) => $data['name'] === 'Génération du Pokémon');
            $dataFirstTypePokemon = array_filter($cellsTable, fn(array $data) => $data['name'] === 'Premier type');
            $dataSecondTypePokemon = array_filter($cellsTable, fn(array $data) => $data['name'] === 'Second type');

            $categoryPokemon = !empty($dataCategoryPokemon) ? current($dataCategoryPokemon)['value'] : null;
            $generationPokemon = !empty($dataGenerationPokemon) ? current($dataGenerationPokemon)['value'] : null;
            $firstType = !empty($dataFirstTypePokemon) ? current($dataFirstTypePokemon)['value'] : null;
            $secondType = !empty($dataSecondTypePokemon) ? current($dataSecondTypePokemon)['value'] : null;

            // Check legendary pokemon
            $cateLinksText = $crawler
                ->filter('.catlinks .mw-normal-catlinks ul li')
                ->each(fn(Crawler $node) => $node->text());

            $nameEnglish = $this->getNameEnglish($crawler);

            // Get image to pokemon
            $imagePokemon = $crawler->filter('.tableaustandard.ficheinfo .illustration img')
                ->attr('src');

            // Remove the first character
            $imagePokemon = substr($imagePokemon, 1);

            $tags[] = [
                'entity' => $pokemon,
                'image' => ApiURLS::POKE_URL . $imagePokemon,
                'nameEnglish' => $nameEnglish,
                'namesJap' => $this->getNameJap($crawler),
                'category' => $categoryPokemon,
                'generation' => $generationPokemon,
                'firstType' => $firstType ? \App\Helper\Str::clean($firstType) : null,
                'secondType' => $secondType ? \App\Helper\Str::clean($secondType) : null,
                'legendary' => in_array(self::LEGENDARY_FR, $cateLinksText),
                'mega_evolution' => str_contains($nameFR, "Méga")
            ];
        }

        return $tags;
    }
}
