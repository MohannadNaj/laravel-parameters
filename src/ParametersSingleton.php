<?php
namespace Parameter;

class ParametersSingleton {

	public function __construct()
	{
        // create a parameters singleton
        app()->singleton('parameter', function () {
            return \Parameter\Parameter::all();
        });

	}
}