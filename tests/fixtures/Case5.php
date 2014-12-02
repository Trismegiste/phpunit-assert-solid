<?php

namespace BadProject;

class Case5
{

    public function evilInstanceOf($obj)
    {
        $obj instanceof stdClass;
    }

    private function evilMethodExists()
    {
        method_exists($object, 'getService');
    }

}