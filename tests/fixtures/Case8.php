<?php

namespace BadProject;

class Case8
{

    public function noHint1($obj)
    {
        $obj->next();
        $obj->valid();
    }

    public function noHint2($obj)
    {
        $obj->prev();
        $obj->valid();
    }

}