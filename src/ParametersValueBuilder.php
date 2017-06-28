<?php

namespace Parameter;

class ParametersValueBuilder
{
    public function buildGroup(& $parameter)
    {
		$parameter->value =  json_encode(
				$parameter->value
			, JSON_HEX_APOS);
    }

    private function buildArrayMeta($parameter)
    {
    	$meta = $parameter->getArrayMeta();

    	if(is_null($meta))
    	{
//    		$columns = $this->getArrayColumns();
    		return [];
    	}

    	return $meta;
    }

    private function getArrayColumns($parameter)
    {
		$value = $parameter->getArrayValue();
		if(!empty($value))
			 return array_keys($value);

		return [];
    }
}
