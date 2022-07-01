<?php

namespace EnricoDeLazzari\EgdClient\Http;

use DOMDocument;
use DOMXPath;
use EnricoDeLazzari\EgdClient\Actions\FormatAction;
use EnricoDeLazzari\HtmlTableToArray\HtmlTableToArray;

class GetPlayers extends Http
{
    protected function getMethod(): string
    {
        return 'POST';
    }

    protected function route(): string
    {
        return 'Find_Player.php';
    }

    public function __invoke(): array
    {
        $body = $this->send([
            'form_params' => [
                'ricerca' => true,
                'country_code' => 'it',

                // orderBy: orderBy=Last_Name
                // viewStart: viewStart=0
                // orderDir:
                // ricerca: 1
                // last_name:
                // name:
                // pin_player:
                // country_code: *
                // club: *
                // filter: 0

            ],
        ])->body();

        $doc = new DOMDocument();
        @$doc->loadHTML((string) $body);
        $xpath = new DOMXPath($doc);

        $tables = $xpath->query(
            '//th[@class="EGD_tabella_player"]//parent::table'
        );

        return FormatAction::items(
            HtmlTableToArray::fromDOMNodeList($tables)->make()
        );
    }
}
