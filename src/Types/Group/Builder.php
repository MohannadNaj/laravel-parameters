<?php

namespace Parameter\Types\Group;

use Parameter\Types\BaseBuilder;

class Builder extends BaseBuilder
{
    public function buildValue()
    {
        return json_encode(
				$this->parameter->value
			, JSON_HEX_APOS);
    }
}