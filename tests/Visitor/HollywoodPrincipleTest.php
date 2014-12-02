<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Visitor;

use Trismegiste\SolidAssert\Visitor\HollywoodPrinciple;

/**
 * HollywoodPrincipleTest tests HollywoodPrinciple visitor
 */
class HollywoodPrincipleTest extends VisitorTestCase
{

    public function testNewStmt()
    {
        $code = 'new stdClass;';
        $this->parseAndTraverseMethod($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $report = $report[0];
        $this->assertRegExp('#new statement at#', $report);
    }

    public function getNonReportKeyword()
    {
        return [
            ['static'],
            ['self'],
            ['parent'],
            ['Swag']
        ];
    }

    /**
     * @dataProvider getNonReportKeyword
     */
    public function testNotStaticCall($scope)
    {
        $code = "$scope::yolo();";
        $this->parseAndTraverseMethod($code);
        $report = $this->sut->getReport();
        $this->assertCount(0, $report);
    }

    public function testStaticCall()
    {
        $code = "Alien::yop();";
        $this->parseAndTraverseMethod($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $this->assertStringStartsWith("static call", $report[0]);
    }

    public function testEvilGlobal()
    {
        $code = 'global $god;';
        $this->parseAndTraverseMethod($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $this->assertStringStartsWith("global", $report[0]);
    }

    protected function createVisitor()
    {
        return new HollywoodPrinciple();
    }

}