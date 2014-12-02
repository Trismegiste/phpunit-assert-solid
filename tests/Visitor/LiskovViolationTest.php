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
        $this->parseAndTraverse($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $report = $report[0];
        $this->assertRegExp('#use of instanceof at#', $report);
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
        $this->parseAndTraverse($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $this->assertRegExp('#^use of#', $report[0]);
    }

    protected function createVisitor()
    {
        return new LiskovViolation();
    }

}