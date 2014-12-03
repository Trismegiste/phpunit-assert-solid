<?php

namespace BadProject;

class Good8
{

    public function callThis($obj)
    {
        $this->next();
    }

    public function hint1(\Iterator $obj)
    {
        $obj->next();
    }

    public function hint2(\Iterator $obj)
    {
        $this->prop->next();
    }

}