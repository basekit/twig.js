<?php

namespace TwigJs\Compiler;

use Twig\Node\Node;
use TwigJs\JsCompiler;
use TwigJs\TypeCompilerInterface;

class InlinePrintCompiler implements TypeCompilerInterface
{
    public function getType()
    {
        return 'Twig\Node\Expression\InlinePrint';
    }

    public function compile(JsCompiler $compiler, Node $node)
    {
        if (!$node instanceof \Twig\Node\Expression\InlinePrint) {
            throw new \RuntimeException(
                sprintf(
                    '$node must be an instanceof of %s, but got "%s".',
                    $this->getType(),
                    get_class($node)
                )
            );
        }

        $compiler
            ->addDebugInfo($node)
            ->raw('print (')
            ->subcompile($node->getNode('node'))
            ->raw(')')
        ;
    }
}
