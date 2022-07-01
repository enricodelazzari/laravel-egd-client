<?php

namespace EnricoDeLazzari\EgdClient\Actions;

class FormatAction
{
    public function __invoke(
        array $data,
        array $except = [],
        array $merge = []
    ): array {
        return collect($data)
            ->mapWithKeys(callback: fn ($value, $key) => [
                app(FormatKeyAction::class)($key) => app(FormatValueAction::class)($value),
            ])
            ->except($except)
            ->merge($merge)
            ->toArray();
    }
}
