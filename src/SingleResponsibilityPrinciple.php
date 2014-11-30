<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\Assert\Solid;

/**
 * SingleResponsibilityPrinciple is an implementation for assertions of SRP
 */
trait SingleResponsibilityPrinciple
{

    public function assertSmallApi($fqcn)
    {
        $refl = new \ReflectionClass($fqcn);
        $meth = $refl->getMethods(\ReflectionMethod::IS_PUBLIC);
        $this->assertLessThanOrEqual(5, count($meth));
    }

}