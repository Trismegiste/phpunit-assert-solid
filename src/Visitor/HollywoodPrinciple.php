<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Visitor;

use PhpParser\Node;

/**
 * HollywoodPrinciple is a visitor for searching HP violation
 */
class HollywoodPrinciple extends MethodContentTracking
{

    protected function enterMethodCode(Node $node)
    {
        switch ($node->getType()) {
            case 'Expr_New':
                $this->pushViolation($node, 'new statement');
                break;

            case 'Expr_StaticCall':
                if (($node->class instanceof Node\Name)) {

                    $name = $node->class->toString();
                    // exclude static call (as seen by PhpParser) on itself :
                    if (!in_array($name, ['parent', 'self', 'static']) &&
                            ($name !== $this->currentClass )) {
                        $this->pushViolation($node, 'static call');
                    }
                }
                break;

            case 'Stmt_Global':
                $this->pushViolation($node, 'global keyword');
                break;
        }
    }

}