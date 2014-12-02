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
    protected $threshold;

    public function __construct($max)
    {
        $this->threshold = $max;
    }

    public function leaveNode(Node $node)
    {
        if ($node->getType() === 'Expr_MethodCall') {
            $called = $node->name;
            if (!$this->hasMethod($called)) {
                $this->nestedCall--;
            }
        }
        parent::leaveNode($node);
    }

    protected function enterMethodCode(Node $node)
    {
        if ($node->getType() === 'Expr_MethodCall') {
            $called = $node->name;
            if (!$this->hasMethod($called)) {
                $this->nestedCall++;
            }
            if ($this->nestedCall >= $this->threshold) {
                $this->pushViolation($node, 'chained calls after ' . $called);
            }
        }
    }

    protected function hasMethod($name)
    {
        $refl = new \ReflectionClass($this->currentClass);

        return $refl->hasMethod($name);
    }

}