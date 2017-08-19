<?php

namespace Parameter\Types;

use Parameter\Parameter;

abstract class BaseRules
{
    protected $parameter;

    public function __construct(Parameter $parameter)
    {
        $this->parameter = $parameter;
    }

    abstract public function newRules();

    abstract public function updateRules();

    public function getNewRules()
    {
        return $this->newRules() + $this->commonNewRules();
    }

    public function getUpdateRules($parameter)
    {
        return $this->updateRules() + $this->commonUpdateRules();
    }

    private function commonNewRules()
    {
        return [
            'name'=>'unique:parameters|required',
            'label' => 'required',
        ];
    }

    private function commonUpdateRules()
    {
        return [
            'value' => 'max:255',
            'lang' => 'required
        ];
    }
}