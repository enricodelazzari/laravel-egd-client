<?php

namespace EnricoDeLazzari\EgdClient\Http;

use DOMDocument;
use DOMNodeList;
use DOMXPath;
use EnricoDeLazzari\HtmlTableToArray\HtmlTableToArray;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class GetPlayerByPinFromHtml extends Http
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
        $pin = '13049520';

        $body = $this->send([
            'form_params' => [
                'key' => $pin,
            ],
        ])->body();

        $doc = new DOMDocument();
        @$doc->loadHTML((string) $body);
        $xpath = new DOMXPath($doc);

        $data = $xpath->query(
            '//form[@name="Player_form"]//input[@type="text"]'
        );

        $data = $this->format(
            $this->mapAttribites($data)
        );

        $name = $xpath->query(
            '//form[@name="Player_form"]//input[@type="text"]'
        );

        //span[@class='plain5']/text()

        return collect($data)
            ->except(['from', 'to'])
            ->merge([
                'pin' => $pin,
                'country' => Str::before($data['country'], ' ('),
                'country_code' => Str::between($data['country'], '(', ')'),
                'gor' => Str::remove(" ({$data['grade']})", $data['gor']),
            ])
            ->toArray();
    }

    protected function mapAttribites(DOMNodeList $attributes): array
    {
        $player = [];

        foreach ($attributes as $attribute) {
            $player[$attribute->getAttribute('name')] = $attribute->getAttribute('value');
        }

        return $player;
    }

    protected function format(array $data): array
    {
        return collect($data)
            ->mapWithKeys(fn ($value, $key) => [
                $this->formatKey($key) => $this->formatValue($value),
            ])
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
