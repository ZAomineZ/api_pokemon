<?php

namespace App\Concern\scrapp\Pokemon\traits;

use InvalidArgumentException;
use Symfony\Component\DomCrawler\Crawler;

trait NameTranslate
{
    protected function getNameEnglish(Crawler $crawler): string
    {
        try {
            $name = $crawler->filter('#mw-content-text .mw-parser-output .ficheinfo tbody tr:nth-child(3) td')
                ->text();
        } catch (InvalidArgumentException $exception) {
            $name = "";
        }

        return $name;
    }

    protected function getNameJap(Crawler $crawler): array
    {
        try {
            $nameKanji = $crawler
                ->filter('#mw-content-text .mw-parser-output .ficheinfo tbody tr:nth-child(2) td span[lang="ja"]')
                ->text();
        } catch (InvalidArgumentException $exception) {
            $nameKanji = $crawler
                ->filter('#mw-content-text .mw-parser-output .ficheinfo tbody tr:nth-child(2) td ruby[lang="ja"] rb')
                ->text();
        }
        $nameJap = $crawler
            ->filter('#mw-content-text .mw-parser-output .ficheinfo tbody tr:nth-child(2) td span[title="Nom déposé officiel"]')
            ->text();

        return [$nameKanji, $nameJap];
    }
}
