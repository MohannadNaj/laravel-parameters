<?php

namespace Parameter;

class ParameterObserver {
	private $dirtyFields = [];

	public function saving(Parameter $parameter)
	{
		$parameter->buildValue();
	}

	public function saved(Parameter $parameter)
	{
		new ParametersSingleton();
	}

	public function updating(Parameter $parameter)
	{
		$this->dirtyFields = $parameter->getDirty();
	}

	public function updated(Parameter $parameter)
	{

	}

	public function deleting(Parameter $parameter)
	{

	}

	public function deleted(Parameter $parameter)
	{
		new ParametersSingleton();
	}

}