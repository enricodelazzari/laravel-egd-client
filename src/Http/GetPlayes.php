<?php

namespace EnricoDeLazzari\EgdClient\Http;

use DOMDocument;
use DOMXPath;
use EnricoDeLazzari\HtmlTableToArray\HtmlTableToArray;
use Illuminate\Support\Arr;

class GetPlayes extends Http
{
    public const METHOD = 'POST';

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

        return $this->format(
            HtmlTableToArray::fromDOMNodeList($tables)->make()
        );
    }

    protected function format(array $data): array
    {
        return collect($data)
            ->map(fn ($item) => collect($item)->mapWithKeys(fn ($value, $key) => [
                $this->formatKey($key) => $this->formatValue($value)
            ]))
            ->toArray();
    }

    protected function formatKey(string $key): string
    {
        return str($key)
            ->trim()
            ->slug('_')
            ->lower()
            ->toString();
    }

    protected function formatValue(string|array|null $value): ?string
    {
        if (is_array($value)) {
            return $value[0] ?? null;
        }

        return $value;
    }
}
