<?php

declare(strict_types=1);

namespace App\Concern\scrapp\Pokemon;

use App\Concern\api\Pokemon\ApiURLS;
use App\Concern\api\Pokemon\Forms;
use App\Concern\http\Client;
use App\Concern\Scrapp\Pokedia;
use App\Concern\scrapp\Pokemon\traits\NameTranslate;
use Illuminate\Support\Str;

final class Names
{
    use NameTranslate;

    public function __construct(
        protected Client $client,
        protected Forms $forms,
    ) {}

    public function namesEnglish(array $pokemons = []): array
    {
        $pokemonsEnglish = [];
        foreach ($pokemons as $pokemon) {
            if (str_contains($pokemon, 'noir')) {
                $pokemon = Str::title($pokemon);
            }
            $crawler = $this->client->request('GET', ApiURLS::POKE_URL . $pokemon);

            $nameEnglish = $this->getNameEnglish($crawler);
            if (empty($nameEnglish)) {
                $nameEnglish = implode(' ', $this->translateName($pokemon));
            }
            $pokemonsEnglish[] = $nameEnglish;
        }

        return $pokemonsEnglish;
    }


    protected function translateName(string $title): array
    {
        $title = Str::replace(["d’", "d'"], 'of ', $title);
        $pokemonParts = explode(' ', $title);
        $pokemonParts = array_filter($pokemonParts);
        $pokemonParts =  array_map(function (string $text) use ($pokemonParts) {
            $newTitle = mb_strtolower($text);
            $wordTitle = ucfirst($newTitle);
            if (str_contains($wordTitle, 'Méga')) {
                $dataTitle = explode('Méga-', $newTitle);
                $wordTitle = end($dataTitle);

                $text = Str::replace("Méga", "Mega", $text);
            }

            // Preg split punctuation
            $replaceWordTitle = Str::replace(['.', '?', '!', ','], [' .', ' ?', ' !', ' ,'], $wordTitle);
            $dataSplit = explode(' ', $replaceWordTitle);
            $wordTitle = $dataSplit[0] ?? "";

            $client = $this->client->request('GET', ApiURLS::POKE_API_URL . $wordTitle);
            $pokemonTranslate = $wordTitle !== 'Sacha' ? $this->getNameEnglish($client) : "";

            if (str_contains($wordTitle, 'Méga')) $pokemonTranslate = "Mega-$pokemonTranslate";

            if (isset($dataSplit[0])) $dataSplit[0] = empty($pokemonTranslate) ? $text : $pokemonTranslate;

            return implode('', $dataSplit);
        }, $pokemonParts);

        // Check form "PokemonController" exist
        foreach ($pokemonParts as $string) {
            $forms = $this->forms->getForms(mb_strtolower($string));
            if (!empty($forms)) {
                foreach ($pokemonParts as $key => $item) {
                    $resultFind = array_filter($forms, function (array $form) use ($item) {
                        $formParts = array_map(fn(string $str) => mb_strtolower($str), explode(' ', $form['nameFR']));
                        return in_array(mb_strtolower($item), $formParts);
                    });
                    if (!empty($resultFind)) {
                        if ($key !== 0) {
                            $pokemonParts[$key] = current($resultFind)['nameEN'];
                        }
                    }
                }
            }
        }

        return $pokemonParts;
    }
}
