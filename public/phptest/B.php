<?php

namespace Test;

class B extends \Test\A
{
    public function __construct($name = '')
    {
        //
    }

    public function setMsg($msg = '')
    {
        return $msg;
    }
}