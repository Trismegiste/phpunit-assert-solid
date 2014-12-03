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

    /**
     * Asserts if all methods parameters for a given class are type-hinted with interface
     * and not class. (loose-coupling)
     */
    public static function isInterfaceHintedParameter()
    {
        return new Assert\InterfaceHintedParameter();
    }

    public static function assertInterfaceHintedParameter($fqcn, $msg = '')
    {
        self::assertThat($fqcn, self::isInterfaceHintedParameter(), $msg);
    }

    /**
     * Asserts if all public methods for a given class are first declared in an interface
     * implemented by this class. (design by contract and ISP)
     */
    public static function hasNoMethodWithoutContract()
    {
        return new Assert\NoMethodWithoutContract();
    }

    public static function assertNoMethodWithoutContract($fqcn, $msg = '')
    {
        self::assertThat($fqcn, self::hasNoMethodWithoutContract(), $msg);
    }

    /**
     * Asserts if a given class has a small public api. Too many methods means too many
     * responsibilities (SRP). Default size is 5
     */
    public static function isSmallApi($n = 5)
    {
        return new Assert\SmallApi($n);
    }

    public static function assertSmallApi($fqcn, $max = 5, $msg = '')
    {
        self::assertThat($fqcn, self::isSmallApi($max), $msg);
    }

    /**
     * Asserts there is no "new" nor Singleton calls in a given class. This ensures
     * object dependencies are injected in this class, not created nor requested (DIP).
     * A variant is "don't ask, tell".
     */
    public static function isHollywoodPrinciple()
    {
        return new Assert\HollywoodPrinciple();
    }

    public static function assertHollywoodPrinciple($fqcn, $msg = '')
    {
        self::assertThat($fqcn, static::isHollywoodPrinciple(), $msg);
    }

    /**
     * Asserts there is no "reflection tricks" which would undermine LSP : is_subclass_of,
     * instanceof, method_exists and class_uses. There is exception for interfaces
     * because, it is less dangerous and a common pattern.
     */
    public static function isLiskovCompliant()
    {
        return new Assert\LiskovCompliant();
    }

    public static function assertLiskovCompliant($fqcn, $msg = '')
    {
        self::assertThat($fqcn, static::isLiskovCompliant(), $msg);
    }

    /**
     * Asserts there is no new in a static method (typically singletons and static factories
     * are use-case) because it is a violation of OCP (and DIP as edge-effect). Standard
     * factories (Factory Method, Builder...) are not targeted by this assertion.
     */
    public static function isNotStaticFactory()
    {
        return new Assert\StaticFactory();
    }

    public static function assertNotStaticFactory($fqcn, $msg = '')
    {
        self::assertThat($fqcn, static::isNotStaticFactory(), $msg);
    }

    /**
     * Asserts a class only knows itself and its close neighbours (Law of Demeter). 
     * This checking is very crude so I can't garantee it will work efficiently.
     */
    public static function isDemeterLawCompliant()
    {
        return new Assert\DemeterLaw();
    }

    public static function assertDemeterLawCompliant($fqcn, $msg = '')
    {
        self::assertThat($fqcn, static::isDemeterLawCompliant(), $msg);
    }

    /**
     * Detects if parameters passed on to methods are actually objects without 
     * type-hinting which is a well-known (and sadly common) bad practice (design by contract
     * violation). Can't detect php tricks like reflection and call_user_func*().
     */
    public static function hasNoHiddenCoupling()
    {
        return new Assert\NoMissingTypeHint();
    }

    public static function assertNoHiddenCoupling($fqcn, $msg = '')
    {
        self::assertThat($fqcn, static::hasNoHiddenCoupling(), $msg);
    }

}