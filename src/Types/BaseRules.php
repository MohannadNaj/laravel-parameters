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
            'label' => 'required_without:lang',
            'lang' => 'required_without:label',
        ];
    }

    private function commonUpdateRules()
    {
        return [
            'value' => 'max:255',
            'lang' => 'required_without:label',
            'label' => 'required_without:lang',
        ];
    }
}