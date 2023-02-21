<?php

namespace App\Service\Parsing;

use App\Enum\Round\RoundTypeEnum;
use App\Helper\EnumHelper;
use App\Models\Games;
use App\Models\Result;
use App\Models\Teams;

class GameResult
{
    private static array $results = [];
    private static array $head = [];
    private static array $body = [];

    private static array $headConfig = [];

    public static function start (Games $game, object $page): bool
    {
        self::$results = [];
        self::$head = [];
        self::$body = [];
        self::$headConfig = [];

        self::setTable($page);

        self::setResults($game);

        self::create();

        return count(self::$results) > 0;
    }

    private static function setTable (object $page): void
    {
        $table = $page->find('table.game-table');

        if ($table->find('tr')) {
            self::setHead($table);
            self::setBody($table);
            self::setHeadConfig();
        }
    }

    private static function setHead (object $table): void
    {
        $thead = $table->find('thead tr');

        foreach ($thead->find('td') as $cell) {
            self::$head[] = mb_strtolower($cell->plaintext);
        }
    }

    private static function setHeadConfig (): void
    {
        foreach (self::$head as $cell) {
            self::$headConfig[$cell] = EnumHelper::getType($cell);
        }
    }

    private static function setBody (object $table): void
    {
        $tbody = $table->find('tr');

        foreach ($tbody as $key => $row) {
            if ($key === 0) {
                continue;
            }

            $tr = [];
            foreach ($row->find('td') as $cell) {
                $tr[] = $cell->plaintext;
            }

            self::$body[] = $tr;
        }
    }

    private static function setResults (Games $games): void
    {
        foreach (self::$body as $place => $row) {
            $countRound = 1;
            $result     = [];

            $result['game_id'] = $games->id;
            $result['place']   = ($place + 1);

            foreach ($row as $key => $cell) {
                $type = self::$headConfig[self::$head[$key]];

                if ($type === '') {
                    continue;
                } elseif ($type === RoundTypeEnum::TEAM) {
                    $result['team_id'] = Teams::firstOrCreate(['title' => $cell])->id;
                } elseif ($type === RoundTypeEnum::ROUND) {
                    $result["round_{$countRound}"] = $cell;

                    $countRound++;
                } elseif ($type === RoundTypeEnum::TOTALS) {
                    $result['total'] = $cell;
                }
            }

            self::$results[] = $result;
        }
    }

    private static function create(): void
    {
        foreach (self::$results as $result) {
            Result::create($result);
        }
    }
}