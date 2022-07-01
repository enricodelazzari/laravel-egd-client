<?php

namespace EnricoDeLazzari\EgdClient\Actions;

class FormatValueAction
{
    public function __invoke(string|array|null $value): ?string
    {
        if (is_array($value)) {
            return $value[0] ?? null;
        }

        if (! is_string($value)) {
            return $value;
        }

        $value = trim($value);

        if ($value === '') {
            return null;
        }

        return $value;
    }
}
