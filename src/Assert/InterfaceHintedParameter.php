<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

/**
 * InterfaceHintedParameter is an assertion for interface-hinted parameters of method
 * Asserts if methods paramters are type-hinted with interface
 * 
 * Does not mean $fqcn is complying LSP but means objects used in $fqcn
 * will tend to follow LSP (unless it uses reflection or instanceof...)
 * 
 * But primarily, it means a good pratice, the "design by contract" 
 */
class InterfaceHintedParameter extends \PHPUnit_Framework_Constraint
{

    /**
     * Returns a string representation of the constraint.
     *
     * @return string
     */
    public function toString()
    {
        return 'only interface-hinted parameters';
    }

    public function evaluate($fqcn, $description = '', $returnResult = FALSE)
    {
        $success = true;
        $refl = new \ReflectionClass($fqcn);

        foreach ($refl->getMethods() as $meth) {
            if (!$this->assertTypeHintedFor($meth, $returnResult)) {
                $success = false;
                break;
            }
        }

        if ($returnResult) {
            return $success;
        }

        if (!$success) {
            $this->fail($other, $description);
        }
    }

    private function assertTypeHintedFor(\ReflectionMethod $meth, $returnResult = FALSE)
    {
        foreach ($meth->getParameters() as $arg) {
            if (!is_null($typeHint = $arg->getClass())) {
                if (!$typeHint->isInterface()) {
                    if ($returnResult) {
                        return false;
                    } else {
                        $this->fail($meth->getDeclaringClass()->name, $typeHint->name
                                . " is not an interface in " . $meth->name);
                    }
                }
            }
        }
    }

}