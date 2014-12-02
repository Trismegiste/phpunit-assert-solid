<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Visitor;

use Trismegiste\SolidAssert\Visitor\StaticFactory;

/**
 * StaticFactoryTest tests the StaticFactory visitor
 */
class StaticFactoryTest extends VisitorTestCase
{

    protected function createVisitor()
    {
        return new StaticFactory();
    }

    public function testNonStaticFactory()
    {
        $code = 'class Swag { function create() { return new stdClass; }}';
        $this->parseAndTraverseMethod($code);
        $report = $this->sut->getReport();
        $this->assertCount(0, $report);
    }

    public function testStaticFactory()
    {
        $code = 'class Swag { public static function create() { return new stdClass; }}';
        $this->parseAndTraverseMethod($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $this->assertRegExp('#OCP#', $report[0]);
    }

}