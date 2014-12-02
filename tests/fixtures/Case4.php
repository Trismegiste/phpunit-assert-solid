<?php

namespace BadProject;

class Case4
{

    public function evilStatic()
    {
        $obj = Singleton::getEvil();
    }

    private function evilGlobal()
    {
        global $godObject;
    }

    protected function mustUseFactory()
    {
        $obj = new Service();
    }

}