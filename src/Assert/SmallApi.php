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
class SmallApi extends \PHPUnit\Framework\Constraint
{

    protected $small;

    public function __construct($small)
    {
        parent::__construct();
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
    public function evaluate($fqcn, $description = '', $returnResult = FALSE)
    {
        $refl = new \ReflectionClass($fqcn);
        $meth = $refl->getMethods(\ReflectionMethod::IS_PUBLIC);
        if (count($meth) > $this->small) {
            // fail
            if ($returnResult) {
                return false;
            } else {
                $this->fail($fqcn, $description);
            }
        }

        if ($returnResult) {
            return true;
        }
    }

}
