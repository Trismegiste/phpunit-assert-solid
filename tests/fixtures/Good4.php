<?php

namespace BadProject;

class Good4
{

    public function method1()
    {
        Good4::method2();
    }

    public static function method2()
    {
        self::missing();
    }

    protected function noise1()
    {
        static::method2();
    }

    private function noise3()
    {
        self::method2();
    }

}
