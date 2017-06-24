<?php

namespace Parameter;

class ParameterObserver {
	private $dirtyFields = [];

	function __construct()
	{
		new ParametersSingleton();
	}

	public function created(Parameter $parameter)
	{

	}

	public function updating(Parameter $parameter)
	{
		$this->dirtyFields = $parameter->getDirty();
	}

	public function updated(Parameter $parameter)
	{
		print_r($this->dirtyFields);
	}

	public function deleting(Parameter $parameter)
	{

	}

	public function deleted(Parameter $parameter)
	{

	}

}