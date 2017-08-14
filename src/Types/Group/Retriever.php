<?php

namespace Parameter\Types\Group;

use Parameter\Types\BaseValueRetriever;

class Retriever extends BaseValueRetriever
{
    public function getValue()
    {
    	$value = is_array($this->value) ? json_encode($this->value) : $this->value;

        return (array) json_decode(
					$value
				);
    }
}