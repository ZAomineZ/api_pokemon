<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Concern\scrapp\Pokemon\Ability;
use App\Concern\scrapp\Pokemon\Move;
use App\Concern\scrapp\Pokemon\Pokemon;
use App\Concern\scrapp\Pokemon\Tags;
use App\Concern\scrapp\Pokemon\Type;
use App\Concern\Translate\Pokemon\Generation;
use App\Services\AbilityService;
use App\Services\GenerationService;
use App\Services\MoveService;
use App\Services\PokemonService;
use App\Services\StatService;
use App\Services\TypeService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

final class ScrappPokemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrapp:pokemon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cette command de scrapper tout les pokemons existant.';

    public function __construct(
        protected Pokemon $pokemon,
        protected \App\Concern\api\Pokemon\Pokemon $pokemonAPI,
        protected Ability $abilityScrapper,
        protected Move $moveScrapper,
        protected Type $typeScrapper,
        protected PokemonService $pokemonService,
        protected TypeService $typeService,
        protected StatService $statService,
        protected MoveService $moveService,
        protected AbilityService $abilityService,
        protected GenerationService $generationService,
        protected Tags $tags,
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $pokemons = $this->pokemon->listPokemons();

        $tags = $this->tags->tags($pokemons);

        foreach ($tags as $tag) {
            $nameFR = $tag['entity']['name_fr'];
            $nameEN = $tag['nameEnglish'];
            $generation = $tag['generation'];

            if (!str_contains($nameEN, "Mega")) {
                $dataPokemon = $this->pokemonAPI->get($nameEN);
            } else {
                $dataPokemon = [];
            }

            $types = $dataPokemon['types'] ?? [];
            $stats = $dataPokemon['stats'] ?? [];
            $moves = $dataPokemon['moves'] ?? [];
            $abilities = $dataPokemon['abilities'] ?? [];

            $pokemon = $this->pokemonService->create([
                'name_fr' => $nameFR,
                'name_en' => $tag['nameEnglish'],
                'name_jap_kanji' => $tag['namesJap'][0],
                'name_jap' => $tag['namesJap'][1],
                'image' => $tag['image'],
                'legendary' => $tag['legendary'],
                'mega_evolution' => $tag['mega_evolution'],
                'weight' => $dataPokemon['weight'] ?? null,
                'height' => $dataPokemon['height'] ?? null,
                'base_experience' => $dataPokemon['base_experience'] ?? null,
                'number' => $dataPokemon['id'] ?? null,
            ]);

            $generationFR = Generation::GENERATIONS_FR[$generation];
            $generationEN = Generation::GENERATIONS_EN[$generationFR];

            $this->generationService->create([
                'name_fr' => $generationFR,
                'name_en' => $generationEN,
                'slug_fr' => Str::slug($generationFR),
                'slug_en' => Str::slug($generationEN),
            ], $pokemon);

            foreach ($types as $type) {
                $typeName = $type['type']['name'];
                $url = $type['type']['url'];

                $typeResponse = $this->typeScrapper->get($url);

                $names = $typeResponse['names'] ?? null;
                $namesData = array_filter($names, function($item) {
                    return $item['language']['name'] === 'fr';
                });
                $nameFR = array_values($namesData)[0]['name'] ?? null;

                $this->typeService->create([
                    'name_en' => $typeName,
                    'name_fr' => $nameFR,
                    'slug_fr' => Str::slug($nameFR),
                    'slug_en' => Str::slug($typeName),
                ], $pokemon);
            }

            $newStats = [];
            foreach ($stats as $stat) {
                $statName = Str::replace('-', '_', $stat['stat']['name']);
                $baseStat = $stat['base_stat'];

                $newStats[$statName] = $baseStat;
            }
            if (!empty($newStats)) $this->statService->create($newStats, $pokemon);

            foreach ($moves as $move) {
                $name = $move['move']['name'];
                $url = $move['move']['url'];

                $moveModel = $this->moveService->getByName($name);

                if (!$moveModel) {
                    $moveResponse = $this->moveScrapper->get($url);

                    $names = $moveResponse['names'];
                    $namesData = array_filter($names, function($item) {
                        return $item['language']['name'] === 'fr';
                    });
                    $nameFR = array_values($namesData)[0]['name'] ?? null;

                    $accuracy = $moveResponse['accuracy'] ?? 0;
                    $power = $moveResponse['power'] ?? 0;
                    $pp = $moveResponse['pp'] ?? 0;

                    $effectEntries = $moveResponse['effect_entries'] ?? [];
                    $effectEntryEN = array_filter($effectEntries, function ($item) {
                        return $item['language']['name'] === 'en';
                    });
                    $effectEntryEN = array_values($effectEntryEN);
                }

                $this->moveService->create([
                    'name_fr' => $nameFR ?? $name,
                    'name_en' => $name,
                    'slug_fr' => Str::slug($nameFR ?? $name),
                    'slug_en' => Str::slug($name),
                    'accuracy' => $accuracy ?? 0,
                    'power' => $power ?? 0,
                    'pp' => $pp ?? 0,
                    'content_en' => !empty($effectEntryEN) ? $effectEntryEN[0]['effect'] : "",
                    'short_content_en' => !empty($effectEntryEN) ? $effectEntryEN[0]['short_effect'] : ""
                ], $pokemon, $moveModel);
            }

            foreach ($abilities as $ability) {
                $name = $ability['ability']['name'];
                $url = $ability['ability']['url'];

                $abilityModel = $this->abilityService->getByNameEN($name);

                if (!$abilityModel) {
                    $abilityResponse = $this->abilityScrapper->get($url);
                    $flavorTextEntries = $abilityResponse['flavor_text_entries'];
                    $names = $abilityResponse['names'] ?? null;
                    $namesData = array_filter($names, function($item) {
                        return $item['language']['name'] === 'fr';
                    });
                    $nameFR = array_values($namesData)[0]['name'] ?? null;

                    $flavorTextEntriesFR = array_filter($flavorTextEntries, function ($item) {
                        return $item['language']['name'] === 'fr';
                    });
                    $flavorTextEntriesEN = array_filter($flavorTextEntries, function ($item) {
                        return $item['language']['name'] === 'en';
                    });
                    $effectEntries = $abilityResponse['effect_entries'] ?? [];
                    $effectEntryEN = array_filter($effectEntries, function ($item) {
                        return $item['language']['name'] === 'en';
                    });
                    $effectEntryEN = array_values($effectEntryEN);
                }

                $this->abilityService->create([
                    'name_en' => $name,
                    'name_fr' => $nameFR ?? $name,
                    'slug_fr' => Str::slug( $nameFR ?? $name),
                    'slug_en' => Str::slug($name),
                    'content_en' => !empty($effectEntryEN) ? $effectEntryEN[0]['effect'] : "",
                    'content_short_en' => !empty($effectEntryEN) ? $effectEntryEN[0]['short_effect'] : ""
                ], $pokemon, $abilityModel);
            }
        }

        $this->info('The command for scrapped all pokemons was successful !');
    }
}
