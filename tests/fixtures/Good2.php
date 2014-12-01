<?php

namespace BadProject;

interface Contract2
{

    public function example();
}

interface Contract22 extends Contract2
{
    
}

class Good2 implements \Countable, Contract22
{

    public function count()
    {
        
    }

    public function example()
    {
        
    }

    protected function noise1()
    {
        
    }

    public static function noise2()
    {
        
    }

    
}
