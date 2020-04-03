<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

/**
 * NoMethodWithoutContract asserts if public method of a class has been declared
 * in previous interface in the inheritance tree.
 * 
 * To follow ISP and design by contract, you need your api be chunked into small interfaces.
 */
class NoMethodWithoutContract extends \PHPUnit\Framework\Constraint\Constraint
{

    /**
     * @inheritdoc
     */
    public function toString(): string
    {
        return 'class implements only methods previously declared in interfaces';
    }

    /**
     * @inheritdoc
     */
    protected function matches($fqcn): bool
    {
        $refl = new \ReflectionClass($fqcn);

        foreach ($refl->getMethods(\ReflectionMethod::IS_PUBLIC) as $meth) {
            // we skip static public and magic method
            if ($meth->isStatic() || preg_match('#^__#', $meth->name)) {
                continue;
            }
            $found = false;
            // we seek in each interface
            foreach ($refl->getInterfaces() as $interf) {
                if ($interf->hasMethod($meth->name)) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                return false;
            }
        }

        return true;
    }

}
