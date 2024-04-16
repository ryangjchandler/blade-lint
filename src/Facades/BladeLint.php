<?php

namespace RyanChandler\BladeLint\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RyanChandler\BladeLint\BladeLintManager
 */
class BladeLint extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RyanChandler\BladeLint\BladeLintManager::class;
    }
}
