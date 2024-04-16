<?php

namespace RyanChandler\BladeLint;

use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\AbstractNode;
use Stillat\BladeParser\Nodes\BaseNode;

class Traverser
{
    protected ErrorCollector $collector;

    public function __construct()
    {
        $this->collector = new ErrorCollector();
    }

    public function traverse(string $file, Document $document, array $rules): void
    {
        $this->collector->setFile($file);

        foreach ($document->getRootNodes() as $node) {
            $this->handleNode($node, $rules);
        }
    }

    protected function handleNode(AbstractNode $node, array $rules): void
    {
        foreach ($rules as $rule) {
            $rule->check($node, $this->collector);
        }

        $children = $node->getDirectChildren();

        if ($children === []) {
            return;
        }

        foreach ($children as $child) {
            $this->handleNode($child, $rules);
        }
    }

    public function getErrorCollector(): ErrorCollector
    {
        return $this->collector;
    }
}
