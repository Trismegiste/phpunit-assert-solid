<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\Assert\Solid;

/**
 * InterfaceSegregationPrinciple is an implementation of assertions for ISP
 */
trait InterfaceSegregationPrinciple
{

    protected function assertMethodCountEquals($inheritFqcn, array $motherFqcn, $delta = 0)
    {
        $methodCount = $delta;
        foreach ($motherFqcn as $fqcn) {
            $methodCount += count(get_class_methods($fqcn));
        }

        $this->assertEquals(count(get_class_methods($inheritFqcn)), $methodCount, "Some methods from class $inheritFqcn are not declared in "
                . implode(', ', $motherFqcn));
    }

}
