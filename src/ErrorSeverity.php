<?php

namespace RyanChandler\BladeLint;

enum ErrorSeverity
{
    case Error;
    case Warning;
    case Info;

    public function getStyle(): string
    {
        return match ($this) {
            self::Error => 'fg=red;options=bold',
            self::Warning => 'fg=yellow;options=bold',
            self::Info => 'fg=blue;options=bold',
        };
    }

    public function toStyledString(): string
    {
        return sprintf('<%s>%s</>', $this->getStyle(), $this->toString());
    }

    public function toString(): string
    {
        return match ($this) {
            self::Error => 'Error',
            self::Warning => 'Warning',
            self::Info => 'Info',
        };
    }
}
