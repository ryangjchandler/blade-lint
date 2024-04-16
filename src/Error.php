<?php

namespace RyanChandler\BladeLint;

use Stillat\BladeParser\Nodes\Position;

readonly class Error
{
    public function __construct(
        public string $file,
        public string $message,
        public Position $position,
        public ErrorSeverity $severity,
    ) {
    }

    public function getLine(): int
    {
        return $this->position->startLine;
    }

    public function getColumn(): int
    {
        return $this->position->startColumn;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getSeverity(): ErrorSeverity
    {
        return $this->severity;
    }
}
