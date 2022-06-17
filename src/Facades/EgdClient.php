<?php

namespace EnricoDeLazzari\EgdClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EnricoDeLazzari\EgdClient\EgdClient
 */
class EgdClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-egd-client';
    }
}
