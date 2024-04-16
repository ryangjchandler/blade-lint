<?php

namespace RyanChandler\BladeLint\Rules;

use RyanChandler\BladeLint\ErrorCollector;
use Stillat\BladeParser\Nodes\AbstractNode;

interface Rule
{
    /**
     * Run the rule against the given node, providing any errors to the error collector.
     */
    public function check(AbstractNode $node, ErrorCollector $errorCollector): void;

    /**
     * Specify the unique ID (name) of the rule – recommended to be a period-separated string,
     * e.g. "echo.no-raw-echo".
     *
     * This is used to disable rules on a per-file or per-node basis.
     */
    public function getRuleId(): string;
}
