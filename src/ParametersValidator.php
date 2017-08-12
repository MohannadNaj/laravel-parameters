<?php

namespace Parameter;

use Parameter\ParametersManager;

class ParametersValidator {

	public static function newRules($type)
	{
		return ['value' => static::getValueRules($type),
				'name'=>'unique:parameters|required',
				'label' => static::commonRules()['label'] . '|required_without:lang',
				'lang' => static::commonRules()['lang'] . '|required_without:label',
				'type' => static::commonRules()['type'],
				];
	}

	public static function updateRules($type) {
		return ['value' => static::getValueRules($type),
				'label' => static::commonRules()['label'],
				'lang' => static::commonRules()['lang']
				];
	}

	public static function commonRules() {
		return ['label' => 'max:255',
				'lang' => 'max:255',
				'type' => 'required|in:' . implode(ParametersManager::$supportedTypes,',')];
	}

	private static function getValueRules($type)
	{
		switch ($type) {

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