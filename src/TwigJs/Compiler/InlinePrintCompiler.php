<?php

namespace TwigJs\Compiler;

use TwigJs\JsCompiler;
use TwigJs\TypeCompilerInterface;

class InlinePrintCompiler implements TypeCompilerInterface
{
    public function getType()
    {
        return 'Twig\Node\Expression\InlinePrint';
    }

    public function compile(JsCompiler $compiler, \Twig_NodeInterface $node)
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
