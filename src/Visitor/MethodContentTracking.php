<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Visitor;

use PhpParser\Node;
use PhpParser\NodeVisitor\NameResolver;

/**
 * MethodContentTracking is a template method pattern for exploring the content
 * of class methods
 */
abstract class MethodContentTracking extends NameResolver
{

    protected $currentNamespace;
    protected $currentClass;
    protected $currentMethod;
    protected $report = [];

    /**
     * gets a compiled report
     * 
     * @return array
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * stack a new line in the report for a given node
     * 
     * @param Node $node
     * @param string $msg
     */
    protected function pushViolation(Node $node, $msg)
    {
        $this->report[] = $msg . ' at line ' . $node->getLine();
    }

    /**
     * @inheritdoc
     */
    public function enterNode(Node $node)
    {
        switch (get_class($node)) {
            case Node\Stmt\Namespace_::class :
                $this->currentNamespace = $node->name;
                break;
            case Node\Stmt\Class_::class :
                $this->currentClass = $node->namespacedName;
                break;
            case Node\Stmt\ClassMethod::class :
                $this->currentMethod = $node->name;
                break;

            default:
                if (!is_null($this->currentMethod)) {
                    $this->enterMethodCode($node);
                }
        }
    }

    /**
     * @inheritdoc
     */
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

    /**
     * Enters a node within a class method
     * 
     * @param Node $node
     */
    abstract protected function enterMethodCode(Node $node);

    /**
     * gets a fqcn from an unqualified name
     * 
     * @param Node $node
     * 
     * @return string
     */
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
