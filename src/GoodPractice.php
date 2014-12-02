<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert;

/**
 * GoodPractice is a helper for assertions
 */
trait GoodPractice
{

    // 1
    public static function isInterfaceHintedParameter()
    {
        return new Assert\InterfaceHintedParameter();
    }

    public static function assertInterfaceHintedParameter($fqcn, $msg = '')
    {
        self::assertThat($fqcn, self::isInterfaceHintedParameter(), $msg);
    }

    // 2
    public static function hasNoMethodWithoutContract()
    {
        return new Assert\NoMethodWithoutContract();
    }

    public static function assertNoMethodWithoutContract($fqcn, $msg = '')
    {
        self::assertThat($fqcn, self::hasNoMethodWithoutContract(), $msg);
    }

    // 3
    public static function isSmallApi($n = 5)
    {
        return new Assert\SmallApi($n);
    }

    public static function assertSmallApi($fqcn, $max = 5, $msg = '')
    {
        self::assertThat($fqcn, self::isSmallApi($max), $msg);
    }

    // 4
    public static function isHollywoodPrinciple()
    {
        return new Assert\HollywoodPrinciple();
    }

    public static function assertHollywoodPrinciple($fqcn, $msg = '')
    {
        self::assertThat($fqcn, static::isHollywoodPrinciple(), $msg);
    }

    // 5
    public static function isLiskovCompliant()
    {
        return new Assert\LiskovCompliant();
    }

    public static function assertLiskovCompliant($fqcn, $msg = '')
    {
        self::assertThat($fqcn, static::isLiskovCompliant(), $msg);
    }

    // 6
    public static function isNotStaticFactory()
    {
        return new Assert\StaticFactory();
    }

    public static function assertNotStaticFactory($fqcn, $msg = '')
    {
        self::assertThat($fqcn, static::isNotStaticFactory(), $msg);
    }

    // 7
    public static function isDemeterLawCompliant()
    {
        return new Assert\DemeterLaw();
    }

    public static function assertDemeterLawCompliant($fqcn, $msg = '')
    {
        self::assertThat($fqcn, static::isDemeterLawCompliant(), $msg);
    }

}