<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

/**
 * AssertParserTemplateTest tests AssertParserTemplate
 */
class AssertParserTemplateTest extends \PHPUnit_Framework_TestCase
{

    public function getGoodCase()
    {
        $fqcn = [];
        foreach (range(1, 8) as $idx) {
            $fqcn[] = ["BadProject\\Case$idx"];
        }

        return $fqcn;
    }

    /**
     * @dataProvider getGoodCase
     */
    public function testNeutral($fqcn)
    {
        $visitor = $this->getMockForAbstractClass('Trismegiste\SolidAssert\Visitor\MethodContentTracking');

        $assert = $this->getMockForAbstractClass('Trismegiste\SolidAssert\Assert\AssertParserTemplate');
        $assert->expects($this->once())
                ->method('createVisitor')
                ->will($this->returnValue($visitor));

        $this->assertTrue($assert->evaluate($fqcn, '', true));
    }

}