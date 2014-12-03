<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert;

/**
 * GoodPracticeTest tests the GoodPractice trait
 */
class GoodPracticeTest extends \PHPUnit_Framework_TestCase
{

    use \Trismegiste\SolidAssert\GoodPractice;

    public function testConcreteTypeHint()
    {
        $this->assertInterfaceHintedParameter('BadProject\Good1');
    }

    public function testContractForMethod()
    {
        $this->assertNoMethodWithoutContract('BadProject\Good2');
    }

    public function testSmallApi()
    {
        $this->assertSmallApi('BadProject\Good3');
    }

    public function testHollywoodPrinciple()
    {
        $this->assertHollywoodPrinciple('BadProject\Good4');
    }

    public function testLiskovCompliance()
    {
        $this->assertLiskovCompliant('BadProject\Good5');
    }

    public function testNotStaticFactory()
    {
        $this->assertNotStaticFactory('BadProject\Case4');
    }

    public function testDemeterLawCompliance()
    {
        $this->assertDemeterLawCompliant('BadProject\Good7');
    }

    public function testNoHiddenCoupling()
    {
        $this->assertNoHiddenCoupling('BadProject\Good8');
    }

}