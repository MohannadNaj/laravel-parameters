<?php

namespace Parameter;

class ParameterObserver {
	protected $loggableFields = ['value','label','lang','category_id'];

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
		$meta = $parameter->meta;
		if(! $meta)
			$meta = [];

		$original = collect($parameter->getOriginal())->only($this->loggableFields);

		$dirtyFields = $parameter->getDirty();

		foreach($dirtyFields as $key => $value) {
			if(is_array($value)) {
				$dirtyFields[$key] = json_encode($value);
			}
		}

		$diff = collect($dirtyFields)->only($this->loggableFields)->diffAssoc($original)->toArray();

		foreach($diff as $key => $value)
		{
			$meta['logs'][] = [
				'old' 	=> $original[$key],
				'new' 	=> $value,
				'auth_id' => auth()->id(),
				'field' => $key,
				'date' 	=> \Carbon\Carbon::now()->toDateTimeString()];
		}

		$parameter->meta = $meta;
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