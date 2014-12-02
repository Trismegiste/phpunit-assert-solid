<?php

namespace BadProject;

class Case6
{

    private static $instance;

    public static function getInstance()
    {
        if (isNull(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

}