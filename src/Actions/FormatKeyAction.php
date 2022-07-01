<?php

namespace EnricoDeLazzari\EgdClient\Actions;

class FormatKeyAction
{
    public function __invoke(string $key): string
    {
        return str($key)
            ->trim()
            ->slug(separator: '_')
            ->lower()
            ->toString();
    }
}
