<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Visitor;

use PhpParser\Node;

/**
 * StaticFactory search for static factory and singleton
 */
class StaticFactory extends MethodContentTracking
{

    public function enterNode(Node $node)
    {
        switch ($node->getType()) {
            case 'Stmt_Class':
                $this->currentClass = $node->name;
                break;
            case 'Stmt_ClassMethod':
                if ($node->isStatic()) {
                    $this->currentMethod = $node->name;
                }
                break;

            default:
                if (!is_null($this->currentMethod)) {
                    $this->enterMethodCode($node);
                }
        }
    }

    protected function enterMethodCode(Node $node)
    {
        switch ($node->getType()) {
            case 'Expr_New':
                $this->pushViolation($node, 'static factory (OCP violation)');
                break;
        }
    }

}