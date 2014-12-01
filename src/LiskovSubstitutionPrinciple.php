<?php

/*
 * phpunit-solid-assertion
 */

namespace Trismegiste\SolidAssert;

/**
 * LiskovSubstitutionPrinciple is an implementation of solid assertions
 * based on LSP, design by contract and loose-coupling.
 */
trait LiskovSubstitutionPrinciple
{

    /**
     * Asserts if there is no use of evil practices that breaks LSP
     * 
     * @param string $fqcn
     */
    protected function assertNoViolation($fqcn)
    {
        // no instanceof
        // no is_subclass
        // use_trait
        // no method_exist...
    }

  
    /**
     * Asserts if no objects are passed as method arguments without a type-hint
     * (not stricly related to LSP but same spirit)
     * 
     * @param string $fqcn
     */
    protected function assertNoHiddenCoupling($fqcn)
    {
        
    }

}