<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Visitor;

use Trismegiste\SolidAssert\Visitor\HollywoodPrinciple;

/**
 * HollywoodPrincipleTest tests HollywoodPrinciple visitor
 */
class HollywoodPrincipleTest extends \PHPUnit_Framework_TestCase
{

    /** @var HollywoodPrinciple */
    protected $sut;

    /** @var \PhpParser\NodeTraverser */
    protected $traverser;

    /** @var \PhpParser\Parser */
    protected $parser;

    protected function parseAndTraverse($code)
    {
        $stmt = $this->parser->parse('<?php ' . $code);
        $this->traverser->traverse($stmt);
    }

    protected function setUp()
    {
        $this->parser = new \PhpParser\Parser(new \PhpParser\Lexer());
        $this->traverser = new \PhpParser\NodeTraverser();
        $this->sut = new HollywoodPrinciple();
        $this->traverser->addVisitor($this->sut);
    }

    public function testBeforeTraverse()
    {
        $this->assertCount(0, $this->sut->getReport());
    }

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

}