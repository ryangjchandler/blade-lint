<?php

namespace RyanChandler\BladeLint\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'install:blade-lint';

    public $description = 'Install and configure Blade Lint.';

    public function handle(): int
    {
        $this->call('vendor:publish', [
            '--tag' => 'blade-lint-config',
            '--force' => true,
        ]);

        $this->outputComponents()->info('Blade Lint has been installed.');

        return self::SUCCESS;
    }
}
