<?php

namespace EnricoDeLazzari\EgdClient\Http;

use DOMDocument;
use DOMElement;
use DOMNodeList;
use DOMXPath;
use EnricoDeLazzari\EgdClient\Actions\FormatAction;
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

        $data = $this->mapAttributes($data);

        return app(FormatAction::class)(
            data: $data,
            except: [
                'from',
                'to',
            ],
            merge: [
                'country' => Str::before($data['country'], ' ('),
                'country_code' => Str::between($data['country'], '(', ')'),
            ]
        );
    }

    protected function mapAttributes(DOMNodeList $attributes): array
    {
        $player = [];

        foreach ($attributes as $attribute) {
            if ($attribute instanceof DOMElement) {
                $player[$attribute->getAttribute('name')] = $attribute->getAttribute('value');
            }
        }

        return $player;
    }
}
