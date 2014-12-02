<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Visitor;

use PhpParser\Node;

/**
 * LiskovViolation tracks bad practice that prevents objects used in this class
 * to follow Liskov. 
 * 
 * In fact this is a violation of Demeter's Law in the first
 * place : If a class method receive an Iterator it doesn't have to know if it is a ArrayObject
 * nor a SplObjectStorage.
 * 
 * By using keywords like instanceof, is_subclass_of, class_uses... you cannot substitute
 * these foreign ojects by their subclasses. That's why you must limit yourself
 * of using these tricks. (But sometimes it unavoidable, I agree)
 * 
 * I don't track uncommon uses like call_user_func('is_subclass_of', $fqcn, $mother)
 * nor Reflection : too complicated
 */
class LiskovViolation extends MethodContentTracking
{

    // I don't put 'class_implements' because it's a common pattern and relying
    // on interface is roughly acceptable. Note: 'method_exists' is the worst function EVAR !
    // and the most useless is 'class_uses' since methods could be aliased.
    private $forbidden = ['is_subclass_of', 'class_uses', 'class_parents', 'method_exists'];

    protected function enterMethodCode(Node $node)
    {
        switch ($node->getType()) {
            case 'Expr_Instanceof':
                $skip = false;
                if ($node->class instanceof Node\Name) {
                    // I accept a clean use of instanceof on an interface
                    $name = (string) $node->class;
                    $skip = interface_exists($name);  // @todo will fail with namespace
                }
                if (!$skip) {
                    $this->pushViolation($node, 'use of instanceof');
                }
                break;

            case 'Expr_FuncCall':
                if (in_array($node->name, $this->forbidden)) {
                    $this->pushViolation($node, 'use of ' . $node->name);
                }
                break;
        }
    }

}