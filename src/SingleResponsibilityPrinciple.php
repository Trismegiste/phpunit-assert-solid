<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\Assert\Solid;

/**
 * SingleResponsibilityPrinciple is an implementation for assertions on SRP
 */
trait SingleResponsibilityPrinciple
{

    public function assertSmallApi($fqcn, $smallApi = 5)
    {
        $refl = new \ReflectionClass($fqcn);
        $meth = $refl->getMethods(\ReflectionMethod::IS_PUBLIC);
        $this->assertLessThanOrEqual($smallApi, count($meth));
    }

}