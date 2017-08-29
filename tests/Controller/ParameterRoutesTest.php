<?php

namespace Parameter\Tests\Controller;

use Mockery;
use StdClass;
use Parameter\Tests\User;
use Parameter\Tests\ControllerTest;

class ParameterRoutesTest extends ControllerTest
{
	public function test_index()
	{
        $response = $this->actingAs(new User())->get('/parameters');
		$this->seeStatusCode(200);
	}
}