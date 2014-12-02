<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Visitor;

use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;

/**
 * MethodContentTracking is a template method ppattern for exploring the content
 * of a class method
 */
abstract class MethodContentTracking extends NodeVisitorAbstract
{

    protected $currentNamespace;
    protected $currentClass;
    protected $currentMethod;
    protected $report = [];

    public function getReport()
    {
        return $this->report;
    }

    protected function pushViolation(Node $node, $msg)
    {
        $this->report[] = $msg . ' at line ' . $node->getLine();
    }

    public function enterNode(Node $node)
    {
        switch ($node->getType()) {
            case 'Stmt_Namespace':
                $this->currentNamespace = $node->name;
                break;
            case 'Stmt_Class':
                $this->currentClass = $this->getFqcn($node);
                break;
            case 'Stmt_ClassMethod':
                $this->currentMethod = $node->name;
                break;

            default:
                if (!is_null($this->currentMethod)) {
                    $this->enterMethodCode($node);
                }
        }
    }

    public function leaveNode(Node $node)
    {
        switch ($node->getType()) {
            case 'Stmt_Class':
                $this->currentClass = null;
                break;
            case 'Stmt_ClassMethod':
                $this->currentMethod = null;
                break;
        }
    }

    abstract protected function enterMethodCode(Node $node);

    protected function getFqcn(Node $node)
    {
        if (null !== $this->currentNamespace) {
            $namespacedName = clone $this->currentNamespace;
            $namespacedName->append($node->name);
        } else {
            $namespacedName = $node->name;
        }

        return (string) $namespacedName;
    }

}