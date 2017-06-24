<?php

namespace Parameter;

class ParametersValidator {

	public static function newRules($type)
	{
		return ['value' => static::getNewRules($type),
				'name'=>'unique:parameters|required',
				'label' => 'required_without:lang',
				'lang' => 'required_without:label',
				];
	}

	private static function getNewRules($type)
	{
		switch ($type) {

			case 'text':
				$rule = '';
				break;

			case 'textfield':
				$rule = 'max:255';
				break;

			case 'boolean':
				$rule = 'boolean';
				break;

			case 'integer':
				$rule = 'integer';
				break;

			default:
				$rule = '';
				break;
		}
		return $rule;
	}
}