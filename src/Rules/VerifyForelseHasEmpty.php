<?php

namespace RyanChandler\BladeLint\Rules;

use Stillat\BladeParser\Nodes\AbstractNode;
use RyanChandler\BladeLint\ErrorCollector;
use Stillat\BladeParser\Nodes\DirectiveNode;
use Stillat\BladeParser\Nodes\Structures\ForElse;

class VerifyForelseHasEmpty implements Rule
{
    public function check(AbstractNode $node, ErrorCollector $errorCollector): void
    {
        if (! $node instanceof DirectiveNode || $node->getForElse() === null) {
            return;
        }

        $forElse = $node->getForElse();

        if ($forElse->getEmptyDirectiveCount() !== 0) {
            return;
        }

        $errorCollector->report($node, 'The <options=bold>@forelse</> directive is missing an <options=bold>@empty</> directive.');
    }

    public function getRuleId(): string
    {
        return 'control-structures.forelse-without-empty';
    }
}
