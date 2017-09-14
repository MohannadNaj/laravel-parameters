<?php

namespace Parameter\Types;

use Parameter\Parameter;

abstract class BaseBuilder
{
    protected $parameter;

    public function __construct(Parameter & $parameter)
    {
        $this->parameter = & $parameter;
    }

    public abstract function buildValue();

    public function build()
    {
        $this->parameter->value = $this->buildValue();
    }
}