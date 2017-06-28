<?php

namespace Parameter;

trait ParametersModelTrait {

    public function getValue()
    {
        return $this->value;
    }

	public function buildValue()
	{
		$parametersBuilder = new ParametersValueBuilder($this);
		$parametersBuilderMethodName = 'build' . ucfirst($this->type);

		if(method_exists($parametersBuilder, $parametersBuilderMethodName))
			$parametersBuilder->$parametersBuilderMethodName($this);
	}

	public function getValueAttribute($value)
	{
        if (is_null($value)) {
            return $value;
        }

		if($this->type == "group")
		{
			if(! is_array($value))
			{
				return (array) json_decode($value, JSON_HEX_APOS);
			}
			return $value;
		}

		if($this->type == "boolean")
		{
			return (bool) $this->type;
		}

		return $value;
	}

	public function getArrayMeta()
	{
		$value = $this->value;

		if(! empty($value) && array_key_exists('meta', $value) )
		{
			return $value['meta'];
		}

		return null;
	}

	public function getArrayValue()
	{
		$value = $this->value;

		if(! empty($value) && array_key_exists('value', $value) )
		{
			return $value['value'];
		}

		return null;
	}
}