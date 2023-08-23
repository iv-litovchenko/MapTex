<?php

namespace Test;

class Composition
{
    private $internal_obj;

    public function __construct()
    {
        $this->internal_obj = new \Test\B;
    }

    public function run($msg = '')
    {
        return $this->internal_obj->setMsg($msg);
    }
}