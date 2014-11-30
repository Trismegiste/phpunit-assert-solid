<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\Assert\Solid;

/**
 * LiskovSubstitutionPrinciple is an implementation of solid assertions
 */
trait LiskovSubstitutionPrinciple
{

    protected function assertInterfaceTypeHinted($fqcn)
    {
        $refl = new \ReflectionClass($fqcn);

        foreach ($refl->getMethods() as $meth) {
            $this->assertTypeHintFor($meth);
        }
    }

    private function assertTypeHintFor(\ReflectionMethod $meth)
    {
        foreach ($meth->getParameters() as $arg) {
            if (!is_null($typeHint = $arg->getClass())) {
                $this->assertTrue($typeHint->isInterface(), $typeHint->name
                        . " is not an interface in "
                        . $meth->getDeclaringClass() . '::' . $meth->name);
            }
        }
    }

    protected function assertNoViolation($fqcn)
    {
        // no instanceof
        // no is_subclass
        // use_trait
        // no method_exist...
    }

}