<?php

namespace BadProject;

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

}