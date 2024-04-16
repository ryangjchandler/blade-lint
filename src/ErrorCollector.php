<?php

namespace RyanChandler\BladeLint;

use Stillat\BladeParser\Nodes\BaseNode;

class ErrorCollector
{
    protected array $errors = [];

    protected int $numberOfErrors = 0;

    protected string $file;

    public function setFile(string $file): void
    {
        $this->file = $file;
    }

    public function report(BaseNode $node, string $message, ErrorSeverity $errorSeverity = ErrorSeverity::Error): void
    {
        if (! isset($this->errors[$this->file])) {
            $this->errors[$this->file] = [];
        }

        $this->numberOfErrors++;
        $this->errors[$this->file][] = new Error($this->file, $message, $node->position, $errorSeverity);
    }

    public function getNumberOfErrors(): int
    {
        return $this->numberOfErrors;
    }

    /**
     * @return array<string, array<Error>>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
