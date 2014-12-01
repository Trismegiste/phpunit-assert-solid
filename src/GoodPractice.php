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

}