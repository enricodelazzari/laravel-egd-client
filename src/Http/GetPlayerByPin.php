<?php

namespace EnricoDeLazzari\EgdClient\Http;

class GetPlayerByPin
{
    public function __invoke(): array
    {
        return array_merge(
            app(GetPlayerByPinFromHtml::class)(),
            app(GetPlayerByPinFromApi::class)()
        );
    }
}
