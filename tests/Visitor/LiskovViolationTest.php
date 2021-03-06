<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Visitor;

use Trismegiste\SolidAssert\Visitor\LiskovViolation;

/**
 * LiskovViolationTest tests LiskovViolation visitor
 */
class LiskovViolationTest extends VisitorTestCase
{

    public function testInstanceOf()
    {
        $code = '$obj instanceof stdClass;';
        $this->parseAndTraverseMethod($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $report = $report[0];
        $this->assertMatchesRegularExpression('#use of instanceof at#', $report);
    }

    public function getReportKeyword()
    {
        return [
            ['is_subclass_of'],
            ['method_exists'],
            ['class_uses'],
            ['class_parents']
        ];
    }

    /**
     * @dataProvider getReportKeyword
     */
    public function testNotStaticCall($func)
    {
        $code = "$func(\$obj,stdClass);";
        $this->parseAndTraverseMethod($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $this->assertMatchesRegularExpression('#^use of#', $report[0]);
    }

    protected function createVisitor()
    {
        return new LiskovViolation();
    }

    public function testInstanceOfInterfaceOk()
    {
        $code = '$obj instanceof \Iterator;';
        $this->parseAndTraverseMethod($code);
        $report = $this->sut->getReport();
        $this->assertCount(0, $report);
    }

}