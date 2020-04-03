<?php

namespace BadProject;

class GoodWithReturn
{

    public function getInteger(): int
    {
        return 3;
    }

    public function getFloatOrNot(): ?float
    {
        if (random_int(0, 1)) {
            return 3.14;
        }
    }

}
