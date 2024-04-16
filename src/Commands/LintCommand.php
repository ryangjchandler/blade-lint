<?php

namespace RyanChandler\BladeLint\Commands;

use Illuminate\Console\Command;
use RyanChandler\BladeLint\BladeLintManager;
use RyanChandler\BladeLint\Error;
use RyanChandler\BladeLint\Traverser;
use Stillat\BladeParser\Document\Document;
use Symfony\Component\Console\Output\OutputInterface;

class LintCommand extends Command
{
    protected $signature = 'blade:lint';

    protected $description = 'Lint all Blade files in the project.';

    public function handle(BladeLintManager $manager)
    {
        $this->outputComponents()->info('Locating Blade files...', OutputInterface::VERBOSITY_VERBOSE);

        $paths = $manager->getRegisteredViewPaths();
        $files = collect();

        foreach ($paths as $path) {
            $files = $files->merge($manager->getBladeFilesInPath($path));
        }

        $this->outputComponents()->info(sprintf('Found %d Blade file(s).', $files->count()), OutputInterface::VERBOSITY_VERBOSE);

        $traverser = new Traverser();
        $rules = $manager->getRules();

        $this->outputComponents()->task('Linting', function () use ($files, $rules, $traverser) {
            foreach ($files as $file) {
                $document = Document::fromText(file_get_contents($file), $file);
                $traverser->traverse($file, $document, $rules);
            }
        });

        $collector = $traverser->getErrorCollector();

        if ($collector->getNumberOfErrors() === 0) {
            $this->outputComponents()->info('No problems found.');

            return self::SUCCESS;
        }

        foreach ($collector->getErrors() as $file => $errors) {
            $this->line(sprintf('%d problem(s) found in %s:', count($errors), basename($file)), 'options=bold');

            $this->table(['Type', 'Line', 'Message'], collect($errors)->map(fn (Error $error) => [
                $error->getSeverity()->toStyledString(),
                $error->getLine(),
                $error->getMessage(),
            ]), 'compact');
        }

        return self::FAILURE;
    }
}
