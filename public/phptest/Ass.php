<?php

namespace Test;

class Ass
{
    public function run(\Test\B $obj, $msg = '')
    {
        return $obj->setMsg('Msg');
    }
}