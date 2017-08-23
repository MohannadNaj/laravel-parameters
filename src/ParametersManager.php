<?php

namespace Parameter;

use Illuminate\Support\Str;

class ParametersManager {
    public static $supportedTypes = ['textfield','text','file','integer','boolean'];

    public static $typesInterface = 'Parameter\\Types\\%s\\';

    public static $addCategoryRequestFields = ['is_category', 'value', 'name','type','label'];

    public static $createParameterFields = ['name','type','label','category_id'];

    public static function getCategoryDefaults() {

        return ['type' => 'textfield',
        'name' => 'category-' . Str::random(),
        'is_category' => true,
        ];
    }

    private static function getTypesInterface($type = null)
    {
    	if(is_null($type))
	    	return static::$typesInterface;

	    return sprintf(static::$typesInterface, ucfirst($type));
    }

    public static function __callStatic($method, $args) {
    	if(! Str::contains($method, 'ClassPath'))
    		return null;

		$target = ucfirst(explode('ClassPath',$method)[0]);

		return static::getTypesInterface(...$args) . $target;
    }
}