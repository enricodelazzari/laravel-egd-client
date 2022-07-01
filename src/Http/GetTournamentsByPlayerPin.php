<?php

namespace EnricoDeLazzari\EgdClient\Http;

use DOMDocument;
use DOMXPath;
use EnricoDeLazzari\HtmlTableToArray\HtmlTableToArray;

class GetTournamentsByPlayerPin extends Http
{
    protected function getMethod(): string
    {
        return 'POST';
    }

    protected function route(): string
    {
        return 'Player_Card.php';
    }

    public function __invoke(): array
    {
        $body = $this->send([
            'form_params' => [
                'key' => '13049520',
                'switch_panel' => 1,
            ],
        ])->body();

        $doc = new DOMDocument();
        @$doc->loadHTML((string) $body);
        //$dom->preserveWhiteSpace = false;
        $xpath = new DOMXPath($doc);

        $tables = $xpath->query(
            '//table/th/a[text()[contains(., "Tournament Code")]]/parent::th/parent::table'
        );

        return //$this->format(
            dd(HtmlTableToArray::fromDOMNodeList($tables)->make())
        //)
        ;
    }
}
