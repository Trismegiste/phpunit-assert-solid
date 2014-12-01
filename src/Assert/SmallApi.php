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
class SmallApi extends \PHPUnit_Framework_Constraint
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
    public function toString()
    {
        return 'class has a small public interface';
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
                var_dump($fqcn, $description);
                $this->fail($fqcn, $description);
            }
        }

        if ($returnResult) {
            return true;
        }
    }

}