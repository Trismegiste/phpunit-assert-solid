<?php

namespace BadProject;

class Good7
{

    public function getter()
    {
        
    }

    public function fluid()
    {
        
    }

    public function nested()
    {
        $this->getter()->fluid()->getSomething();
    }

}