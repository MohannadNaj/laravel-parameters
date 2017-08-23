<?php

namespace Parameter;

use Parameter\ParametersManager;

class ParametersValidator {
	public static $typesInterface = 'Parameter\\Types\\%s\\Rules';

	public static function newRules($type)
	{
		return static::getRules($type, 'new');
	}

	public static function updateRules($type) {
		return static::getRules($type, 'update');
	}

	private static function getRules($type, $operation)
	{
		$rulesClass = static::getRulesClass($type);
		$rulesMethod = static::getOperationRulesMethod($operation);
		return (new $rulesClass)->$rulesMethod();
	}

	private static function getRulesClass($type) {
		$classPath = static::getClassPath(ucfirst( $type));

		if(! class_exists($classPath))
			$classPath = static::getClassPath('_Default');

		return $classPath;
	}

	private static function getOperationRulesMethod($operation) {
			return 'get' . ucfirst($operation) . 'Rules';
	}

	private static function getClassPath($type)
	{
		return sprintf(static::$typesInterface, $type);
	}
}