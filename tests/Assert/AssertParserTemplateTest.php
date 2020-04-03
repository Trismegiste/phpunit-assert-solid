<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

/**
 * AssertParserTemplateTest tests AssertParserTemplate
 */
class AssertParserTemplateTest extends \PHPUnit\Framework\TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $visitor = $this->getMockForAbstractClass('Trismegiste\SolidAssert\Visitor\MethodContentTracking');

        $this->sut = $this->getMockForAbstractClass('Trismegiste\SolidAssert\Assert\AssertParserTemplate');
        $this->sut->expects($this->once())
            ->method('createVisitor')
            ->will($this->returnValue($visitor));
    }

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
        $this->assertTrue($this->sut->evaluate($fqcn, '', true));
    }

}
