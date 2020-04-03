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
class InterfaceHintedParameter extends \PHPUnit\Framework\Constraint\Constraint
{

    /**
     * @inheritdoc
     */
    public function toString(): string
    {
        return 'only interface-hinted parameters';
    }

    /**
     * @inheritdoc
     */
    protected function matches($fqcn): bool
    {
        $refl = new \ReflectionClass($fqcn);

        foreach ($refl->getMethods() as $meth) {
            if (!$this->assertTypeHintedFor($meth)) {
                return false;
            }
        }

        return true;
    }

    private function assertTypeHintedFor(\ReflectionMethod $meth)
    {
        foreach ($meth->getParameters() as $arg) {
            if (!is_null($typeHint = $arg->getClass())) {
                if (!$typeHint->isInterface()) {
                    return false;
                }
            }
        }

        return true;
    }

}
