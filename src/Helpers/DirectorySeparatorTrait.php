<?php

namespace Parameter\Helpers;

trait DirectorySeparatorTrait {
	public function formatPath($subject)
	{
		return $var = str_replace(array('/', '\\','\\\\'), DIRECTORY_SEPARATOR, $subject);
	}
}