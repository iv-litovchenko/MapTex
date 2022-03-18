<?php

namespace Test;

class Aggregation
{
    private $internal_obj;

    /**
     * @param \Test\B $external_obj
     */
    public function __construct(\Test\B $external_obj)
    {
        $this->internal_obj = $external_obj;
    }

    public function run($msg = '')
    {
        return $this->internal_obj->setMsg($msg);
    }
}