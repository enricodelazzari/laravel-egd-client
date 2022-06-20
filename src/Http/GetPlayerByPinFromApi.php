<?php

namespace EnricoDeLazzari\EgdClient\Http;

use DOMNodeList;
use Illuminate\Support\Str;

class GetPlayerByPinFromApi extends Http
{
    protected function getMethod(): string
    {
        return 'GET';
    }

    protected function route(): string
    {
        return 'GetPlayerDataByPIN.php';
    }

    public function __invoke(): array
    {
        $pin = '13049520';

        $body = $this->send([
            'query' => [
                'pin' => $pin,
            ],
        ])->json();

        dd($body);

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
