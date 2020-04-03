<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

use PHPUnit\Framework\Constraint\Constraint;
use ReflectionClass;

/**
 * TypeHintedMethodReturn asserts that all FQCN's methods have type-hinted returned value
 */
class TypeHintedMethodReturn extends Constraint
{

    public function toString(): string
    {
        return 'only type-hinted returned values';
    }

    protected function matches($fqcn): bool
    {
        $refl = new ReflectionClass($fqcn);

        foreach ($refl->getMethods() as $meth) {
            if (!$meth->hasReturnType()) {
                return false;
            }
        }

        return true;
    }

}
