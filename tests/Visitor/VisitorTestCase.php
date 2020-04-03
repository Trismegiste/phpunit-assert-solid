<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Visitor;

use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use PHPUnit\Framework\TestCase;

/**
 * VisitorTestCase tests a visitor
 */
abstract class VisitorTestCase extends TestCase
{

    /** @var NodeVisitorAbstract */
    protected $sut;

    /** @var NodeTraverser */
    protected $traverser;

    /** @var Parser */
    protected $parser;

    protected function parseAndTraversePhp($code)
    {
        $stmt = $this->parser->parse('<?php ' . $code);
        $this->traverser->traverse($stmt);
    }

    protected function parseAndTraverseMethod($code)
    {
        $this->parseAndTraversePhp('class Swag { function yolo() { ' . $code . ' }}');
    }

    abstract protected function createVisitor();

    protected function setUp(): void
    {
        $this->parser = (new ParserFactory)->create(ParserFactory::ONLY_PHP7);
        $this->traverser = new NodeTraverser();
        $this->sut = $this->createVisitor();
        $this->traverser->addVisitor($this->sut);
    }

    public function testBeforeTraverse()
    {
        $this->assertCount(0, $this->sut->getReport());
    }

}