<?php

namespace BadProject;

class Good4
{

    public function method1()
    {
        Good4::method1();
    }

    public static function method2()
    {
        parent::missing();
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
