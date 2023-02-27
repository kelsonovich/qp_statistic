<?php

namespace App\Service\Parsing;

use App\Models\Game;
use voku\helper\HtmlDomParser;

class GameList
{
    private static string $url = '';

    public static function start (int $pageNumber): bool
    {
        self::setUrl();

        $page = HtmlDomParser::file_get_html(self::$url . $pageNumber);

        foreach ($page->find('div.schedule-column') as $gameCard) {
            $link = $gameCard->find('a.schedule-block-head', 0)->attr['href'];

            $gameNumber = (int) substr($link, (stripos($link, '=') + 1), strlen($link));

            if (Game::isExists($gameNumber)) {
                return true;
            }

            Game::start($gameNumber, $gameCard);
        }

        return false;
    }

    public static function setUrl(): void
    {
        self::$url = env('PARSING_LINK');
    }
}
