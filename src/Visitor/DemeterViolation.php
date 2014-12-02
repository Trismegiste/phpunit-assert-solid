<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Visitor;

use PhpParser\Node;

/**
 * DemeterViolation is a visitor for tracking Demeter's Law violation
 * 
 * Again, the soft-typing of PHP cannot ensure absolute detections.
 * Fluid interface will fail, as well as chaining variables in muliple lines.
 */
class DemeterViolation extends MethodContentTracking
{

    protected $nestedCall = 0;

    public function leaveNode(Node $node)
    {
        if ($node->getType() === 'Expr_MethodCall') {
            $called = $node->name;
            if (!method_exists($this->currentClass, $called)) {
                $this->nestedCall--;
            }
        }
        parent::leaveNode($node);
    }

    protected function enterMethodCode(Node $node)
    {
        if ($node->getType() === 'Expr_MethodCall') {
            $called = $node->name;
            if (!method_exists($this->currentClass, $called)) {
                $this->nestedCall++;
            }
            if ($this->nestedCall >= 2) {
                $this->pushViolation($node, 'chained calls after ' . $called);
            }
        }
    }

}