<?php

namespace App\Service\Parsing;

use App\Enum\GameStatusEnum;
use App\Models\Games;
use App\Models\Thematics;
use PHPUnit\Exception;
use voku\helper\HtmlDomParser;

class GameParsingService
{
    private static string $url;
    private static int $thematicId;

    public static function start (): null
    {
        $game = Games::getNextForParsing();

        if (! $game) {
            return null;
        }

        self::setUrl($game->number);

        try {
            $page = HtmlDomParser::file_get_html(self::$url);
        } catch (\Exception $exception) {
            Games::setError($game);

            return null;
        }

        $game->thematic_id = self::getThematicId($page);

        try {
            $resultExists = GameResult::start($game, $page);

            $game->status = ($resultExists) ? GameStatusEnum::FINISHED : GameStatusEnum::WITHOUT_RESULT;
            $game->save();
        } catch (\Exception $exception) {
            Games::setError($game);

            return null;
        }


        return null;
    }

    private static function setUrl (int $number): void
    {
        self::$url = env('PARSING_LINK_GAME') . $number;
    }

    public static function getThematicId (object $page): int
    {
        $thematic = $page->find('div.game-tag', 0)->plaintext;

        $thematicModel = Thematics::firstOrCreate(['title' => $thematic]);

        return $thematicModel->id;
    }
}
