<?php

namespace EnricoDeLazzari\EgdClient\Http;

class GetPlayerByPin
{
    public function __invoke(int|string $pin): array
    {
        return array_merge(
            app(GetPlayerByPinFromHtml::class)($pin),
            app(GetPlayerByPinFromApi::class)($pin)
        );
    }
}
