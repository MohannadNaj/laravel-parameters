<?php

namespace App\Parameter;

class ParametersValidator {

	public static function newRules($type)
	{
		return ['value' => static::getNewRules($type), 'name'=>'unique:parameters|required'];
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
				$rule = 'in:0,1';
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