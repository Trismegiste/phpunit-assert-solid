<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

use PhpParser;
use Trismegiste\SolidAssert\Visitor;

/**
 * HollywoodPrinciple is an assertion on the famous "don't call us we call you"
 * 
 * The DIP is a much stronger principle since it applies also to abstraction 
 * & inheritance but it is much difficult to assert.
 */
class HollywoodPrinciple extends \PHPUnit_Framework_Constraint
{

    public function toString()
    {
        return "class is following Hollywood principle";
    }

    public function evaluate($other, $description = '', $returnResult = false)
    {
        $refl = new \ReflectionClass($other);
        $filename = $refl->getFileName();

        $parser = new PhpParser\Parser(new PhpParser\Lexer());
        $traverser = new PhpParser\NodeTraverser();
        $visitor = new Visitor\HollywoodPrinciple();
        $traverser->addVisitor($visitor);

        try {
            $stmt = $parser->parse(file_get_contents($filename));
            $traverser->traverse($stmt);
        } catch (PhpParser\Error $e) {
            echo 'Parse Error: ', $e->getMessage();
        }

        $report = $visitor->getReport();

        if ($returnResult) {
            return !count($report);
        } else {
            if (count($report)) {
                $this->fail($other, $description . implode(PHP_EOL, $report));
            }
        }
    }

}