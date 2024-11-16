<?php

declare(strict_types=1);

namespace App\Concern\api\Pokemon;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

final class Forms
{
    public function getForms(string $pokemon): array
    {
        try {
            $response = Http::get(ApiURLS::POKE_API_URL . "/pokemon/$pokemon");
        } catch (ConnectionException $exception) {
            $response = [];
        }
        $responseJSON = $response->json() ?? [];

        $forms = $responseJSON['forms'] ?? [];
        $formsData =  [];
        foreach ($forms as $form) {
            $responseForm = Http::get($form['url']);
            $responseFormJSON = $responseForm->json() ?? [];

            $formNames = $responseFormJSON['form_names'];

            $formNameFRData = array_filter($formNames, fn(array $item) => $item['language']['name'] === "fr");
            $formNameENData = array_filter($formNames, fn(array $item) => $item['language']['name'] === "en");
            $formNameFR = $formNameFRData ? current($formNameFRData)['name'] : '';
            $formNameEN = $formNameENData ? current($formNameENData)['name'] : '';

            $formsData[] = ['nameFR' => $formNameFR, 'nameEN' => $formNameEN];
        }

        return $formsData;
    }
}
