<?php

namespace RyanChandler\BladeLint\Rules;

use RyanChandler\BladeLint\ErrorCollector;
use Stillat\BladeParser\Nodes\AbstractNode;
use Stillat\BladeParser\Nodes\EchoNode;
use Stillat\BladeParser\Nodes\EchoType;

class DisallowRawEcho implements Rule
{
    public function check(AbstractNode $node, ErrorCollector $errorCollector): void
    {
        if (! $node instanceof EchoNode) {
            return;
        }

        $node = $node->asEcho();

        if ($node->type !== EchoType::RawEcho) {
            return;
        }

        $errorCollector->report($node, 'Raw echo tags are not allowed.');
    }

    public function getRuleId(): string
    {
        return 'echo.no-raw-echo';
    }
}
