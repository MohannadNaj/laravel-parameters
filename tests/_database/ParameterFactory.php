<?php

use Parameter\Parameter;
use Parameter\ParametersManager;

$factory->define(
	Parameter::class,
	function (Faker\Generator $faker) {
		dd(Parameter::getColumns());
	    return [
	        'name' => '',
	        'commercial_record_number' => $faker->name,
	        'file' => str_random(10) . "." . $faker->fileExtension
	    ];
	});
