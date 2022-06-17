<?php

namespace EnricoDeLazzari\EgdClient\Commands;

use Illuminate\Console\Command;

class EgdClientCommand extends Command
{
    public $signature = 'laravel-egd-client';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
