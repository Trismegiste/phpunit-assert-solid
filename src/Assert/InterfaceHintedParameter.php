<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

/**
 * Interface is the highest level of abstraction, so if you type-hint all methods parameters
 * with interfaces, you have good chance to ensure the OCP in this object 
 * and the LSP in client objects.
 * 
 * Nonetheless, it does not eliminate the circle-ellipse problem but in the worst
 * case, you still have a loose-coupled system.
 */
class InterfaceHintedParameter extends \PHPUnit_Framework_Constraint
{

    /**
     * @inheritdoc
     */
    public function toString()
    {
        return 'only interface-hinted parameters';
    }

    /**
     * @inheritdoc
     */
    public function evaluate($fqcn, $description = '', $returnResult = FALSE)
    {
        $success = true;
        $refl = new \ReflectionClass($fqcn);

        foreach ($refl->getMethods() as $meth) {
            if (!$this->assertTypeHintedFor($meth, $description, $returnResult)) {
                $success = false;
                break;
            }
        }

        if ($returnResult) {
            return $success;
        }
    }

    private function assertTypeHintedFor(\ReflectionMethod $meth, $description = '', $returnResult = FALSE)
    {
        foreach ($meth->getParameters() as $arg) {
            if (!is_null($typeHint = $arg->getClass())) {
                if (!$typeHint->isInterface()) {
                    if ($returnResult) {
                        return false;
                    } else {
                        $this->fail($meth->getDeclaringClass()->name, $description . PHP_EOL
                                . $typeHint->name
                                . " is not an interface in " . $meth->name);
                    }
                }
            }
        }

        return true;
    }

}