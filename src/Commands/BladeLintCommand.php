<?php

namespace RyanChandler\BladeLint\Commands;

use Illuminate\Console\Command;

class BladeLintCommand extends Command
{
    public $signature = 'blade-lint';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
