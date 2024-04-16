<?php

namespace RyanChandler\BladeLint;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\View\FileViewFinder;
use RyanChandler\BladeLint\Rules\Rule;
use Symfony\Component\Finder\Finder;

class BladeLintManager
{
    public function __construct(
        protected Application $laravel,
        protected FileViewFinder $viewFinder,
        protected array $ruleClasses,
    ) {}

    public function getRegisteredViewPaths(): Collection
    {
        return collect($this->viewFinder->getPaths());
    }

    public function getBladeFilesInPath(string $path): Collection
    {
        return collect(
            Finder::create()
                ->in($path)
                ->exclude('vendor')
                ->name('*.blade.php')
                ->files()
        );
    }

    /**
     * @return array<Rules\Rule>
     */
    public function getRules(): array
    {
        return array_map(fn (string $ruleClass): Rule => $this->laravel->make($ruleClass), $this->ruleClasses);
    }
}
