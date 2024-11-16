<?php

declare(strict_types=1);

namespace App\Concern\scrapp\Pokemon;

use Illuminate\Support\Facades\Http;
use Symfony\Component\BrowserKit\HttpBrowser;

final class Ability
{
    public function __construct(
        protected HttpBrowser $client
    ) {}

    public function get(string $uri)
    {
        $response = Http::get($uri);

        return $response->json() ?? [];
    }
}
