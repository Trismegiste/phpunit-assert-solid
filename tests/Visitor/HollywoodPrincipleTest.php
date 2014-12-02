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
        $code = 'class Toto { function arf() { new stdClass; }}';
        $this->parseAndTraverse($code);
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
            ['Toto']
        ];
    }

    /**
     * @dataProvider getNonReportKeyword
     */
    public function testNotStaticCall($scope)
    {
        $code = "class Toto { function arf() { $scope::arf(); }}";
        $this->parseAndTraverse($code);
        $report = $this->sut->getReport();
        $this->assertCount(0, $report);
    }

    public function testStaticCall()
    {
        $code = "class Toto { function arf() { Alien::arf(); }}";
        $this->parseAndTraverse($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $this->assertStringStartsWith("static call", $report[0]);
    }

    public function testEvilGlobal()
    {
        $code = 'class Toto { function arf() { global $god; }}';
        $this->parseAndTraverse($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $this->assertStringStartsWith("global", $report[0]);
    }

    protected function createVisitor()
    {
        return new HollywoodPrinciple();
    }

}