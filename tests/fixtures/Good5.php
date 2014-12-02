<?php

namespace BadProject;

interface Param5 {}

class Good5
{

    public function acceptable()
    {
        $obj instanceof \Iterator;
        $obj instanceof \Traversable;
        $obj instanceof \Countable;
    }

    public function interfaceOk()
    {
        class_implements('Iterator');
    }
    
    public function interfaceOkWithNs()
    {
        $obj instanceof Param5;
    }

}