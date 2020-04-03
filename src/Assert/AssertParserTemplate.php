<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

use PhpParser;
use PhpParser\ParserFactory;
use PHPUnit\Framework\Constraint\Constraint;
use ReflectionClass;
use Trismegiste\SolidAssert\Visitor;

/**
 * AssertParserTemplate is a factory method for assertion based on a parser
 */
abstract class AssertParserTemplate extends Constraint
{

    /**
     * @inheritdoc
     */
    protected function matches($other): bool
    {
        $refl = new ReflectionClass($other);
        $filename = $refl->getFileName();

        $parser = (new ParserFactory)->create(ParserFactory::ONLY_PHP7);
        $traverser = new PhpParser\NodeTraverser();
        $visitor = $this->createVisitor();
        $traverser->addVisitor(new \PhpParser\NodeVisitor\NameResolver());
        $traverser->addVisitor($visitor);

        try {
            $stmt = $parser->parse(file_get_contents($filename));
            $traverser->traverse($stmt);
        } catch (PhpParser\Error $e) {
            echo 'Parse Error: ', $e->getMessage();
        }

        $report = $visitor->getReport();

        return !count($report);
    }

    /**
     * Creates the visitor for this assertion
     * (this is the factory method)
     * 
     * @return Visitor\MethodContentTracking
     */
    protected abstract function createVisitor();
}
