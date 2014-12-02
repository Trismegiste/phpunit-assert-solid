<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Visitor;

/**
 * VisitorTestCase tests a visitor
 */
abstract class VisitorTestCase extends \PHPUnit_Framework_TestCase
{

    /** @var \PhpParser\NodeVisitorAbstract */
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

    abstract protected function createVisitor();

    protected function setUp()
    {
        $this->parser = new \PhpParser\Parser(new \PhpParser\Lexer());
        $this->traverser = new \PhpParser\NodeTraverser();
        $this->sut = $this->createVisitor();
        $this->traverser->addVisitor($this->sut);
    }

    public function testBeforeTraverse()
    {
        $this->assertCount(0, $this->sut->getReport());
    }

}