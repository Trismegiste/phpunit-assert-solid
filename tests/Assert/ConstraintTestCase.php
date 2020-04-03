<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

/**
 * ConstraintTestCase is a template for testing Constraint
 */
abstract class ConstraintTestCase extends \PHPUnit\Framework\TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $this->sut = $this->createConstraint();
    }

    protected abstract function createConstraint();

    public abstract function getBadCase();

    /**
     * @dataProvider getBadCase
     */
    public function testReturnFailure($data)
    {
        $this->assertFalse($this->sut->evaluate($data, '', true));
    }

    /**
     * @dataProvider getBadCase
     */
    public function testExceptionFailure($data)
    {
        $this->expectException(\PHPUnit\Framework\ExpectationFailedException::class);
        $this->sut->evaluate($data);
    }

    public abstract function getGoodCase();

    /**
     * @dataProvider getGoodCase
     */
    public function testReturnSuccess($good)
    {
        $this->assertTrue($this->sut->evaluate($good, '', true));
    }

    /**
     * @dataProvider getGoodCase
     */
    public function testNoExceptionSuccess($good)
    {
        $this->expectNotToPerformAssertions();
        $this->sut->evaluate($good);
    }

}
