<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert\Assert;

/**
 * SmallApi asserts if object keeps a small public interface
 * 
 * This is closely related to SRP and ISP
 */
class SmallApi extends \PHPUnit\Framework\Constraint\Constraint
{

    protected $small;

    public function __construct($small)
    {
        $this->small = $small;
    }

    /**
     * @inheritdoc
     */
    public function toString(): string
    {
        return "class has a small public interface ({$this->small} methods max)";
    }

    /**
     * @inheritdoc
     */
    protected function matches($fqcn): bool
    {
        $refl = new \ReflectionClass($fqcn);
        $meth = $refl->getMethods(\ReflectionMethod::IS_PUBLIC);

        return (count($meth) <= $this->small);
    }

}
