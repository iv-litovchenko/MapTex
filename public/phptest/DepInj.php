<?php

namespace Test;

class DepInj
{
    /**
     * Annotation combined with phpdoc:
     *
     * @Inject
     * @var Foo
     */
    private $b;


    /**
     * Annotation combined with phpdoc:
     *
     * @Inject
     * @param B $b
     */
    public function __construct(\Test\B $b)
    {
        $this->b = $b;
    }

    public function run($msg = '')
    {
        return $this->b->setMsg($msg);
    }
}