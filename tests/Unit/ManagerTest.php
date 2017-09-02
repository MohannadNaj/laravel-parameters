<?php

namespace Parameter\Tests\Unit;

use Mockery;
use StdClass;
use Parameter\Tests\UnitTest;
use Parameter\ParametersManager;

class ManagerTest extends UnitTest
{
	public function test_static_arrays_exist()
	{
		$this->assertArrayContains(['textfield','boolean'], ParametersManager::$supportedTypes);
	}
	public function test_static_call_works()
	{
		$this->assertEquals('Parameter\Types\Text\Builder' ,
			ParametersManager::builderClassPath('text'));
	}
}