<?php

namespace App\Service\Parsing;

use voku\helper\HtmlDomParser;

class GameListParsingService
{
    private static int $countPage = 0;

    public static function start (): void
    {
        self::setCountPages();

        foreach (range(1, self::$countPage) as $page) {
            $isNeededToStop = GameList::start($page);

            if ($isNeededToStop) {
                break;
            }
        }
    }

    public static function setCountPages (): void
    {
        $page = HtmlDomParser::file_get_html(env('PARSING_LINK'));

        foreach ($page->find('ul.pagination li') as $paginationItem) {
            $text = trim(htmlspecialchars($paginationItem->plaintext));

            if (self::$countPage < (int) $text) {
                self::$countPage = $text;
            }
        }
    }
}
