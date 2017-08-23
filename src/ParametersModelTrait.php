<?php

namespace Parameter;

use Parameter\ParametersManager;

trait ParametersModelTrait {

    public function getValue()
    {
        return $this->value;
    }

	public function buildValue()
	{
		$parameterBuilderClassName = 'Parameter\\Types\\' . ucfirst($this->type) . '\\Builder';
		$parameterBuilder = new $parameterBuilderClassName($this);
		$parameterBuilder->build();
	}

	public function getValueAttribute($value)
	{
		$parameterRetrieverClassName = 'Parameter\\Types\\' . ucfirst($this->type) . '\\Retriever';
		$parameterRetriever = new $parameterRetrieverClassName($value);

		return $parameterRetriever->getValue();
	}

	public static function getColumns()
	{
		$instance = new self;
		return $instance->getConnection()->getSchemaBuilder()->getColumnListing($instance->getTable());
	}
}