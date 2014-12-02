<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Visitor;

use Trismegiste\SolidAssert\Visitor\DemeterViolation;

/**
 * DemeterViolationTest tests the visitor DemeterViolation
 */
class DemeterViolationTest extends VisitorTestCase
{

    protected function createVisitor()
    {
        return new DemeterViolation(2);
    }

    public function testNestedCall()
    {
        $code = 'class Swag' . rand() . ' { function yolo() { $obj->call1()->call2(); }}';
        eval($code);
        $this->parseAndTraversePhp($code);
        $this->assertCount(1, $this->sut->getReport());
    }

    public function testIgnoreNestedCallSelf()
    {
        $code = 'class Swag' . rand() . ' { function getter() {} function tested() { $this->getter()->called(); }}';
        eval($code);
        $this->parseAndTraversePhp($code);
        $this->assertCount(0, $this->sut->getReport());
    }

}