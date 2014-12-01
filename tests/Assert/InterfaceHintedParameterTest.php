<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Assert;

use Trismegiste\SolidAssert\Assert\InterfaceHintedParameter;

/**
 * InterfaceHintedParameterTest tests InterfaceHintedParameter
 */
class InterfaceHintedParameterTest extends \PHPUnit_Framework_TestCase
{

    /** @var InterfaceHintedParameter */
    protected $sut;

    protected function setUp()
    {
        $this->sut = new InterfaceHintedParameter();
    }

    public function testReturnFailure()
    {
        $this->assertFalse($this->sut->evaluate('BadProject\Case1', '', true));
    }

    public function testExceptionFailure()
    {
        try {
            $this->sut->evaluate('BadProject\Case1');
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
            return;
        }

        $this->fail();
    }

    public function testReturnSuccess()
    {
        $this->assertTrue($this->sut->evaluate('BadProject\Good1', '', true));
    }

    public function testNoExceptionSuccess()
    {
        $this->sut->evaluate('BadProject\Good1');
    }

}