<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Visitor;

use PhpParser\Node;

/**
 * MissingTypeHint is a visitor to find missing type-hint in method parameter
 */
class MissingTypeHint extends MethodContentTracking
{

    protected $objectName = [];

    protected function enterMethodCode(Node $node)
    {
        // track all variables use in method call
        if ($node->getType() === 'Expr_MethodCall') {
            // track only simple variables
            if (($node->var instanceof Node\Expr\Variable) &&
                    (is_string($node->var->name))) {
                $this->objectName[$node->var->name] = $node;
            }
        }
    }

    public function leaveNode(Node $node)
    {
        if ($node->getType() === 'Stmt_ClassMethod') {
            // filters param without type-hint
            $filtered = [];
            foreach ($node->params as $param) {
                if (is_null($param->type)) {
                    $filtered[$param->var->name] = true;
                }
            }
            // intersect with variable called with method
            $result = array_intersect_key($this->objectName, $filtered);
            foreach ($result as $key => $calling) {
                $this->pushViolation($calling, "Method is called on parameter \$$key without type-hint");
            }
            $this->objectName = [];
        }

        parent::leaveNode($node);
    }

}