<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Visitor;

use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;

/**
 * HollywoodPrinciple is a visitor for searching HP violation
 */
class HollywoodPrinciple extends NodeVisitorAbstract
{

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
            case 'Stmt_Class':
                $this->currentClass = $node->name;
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