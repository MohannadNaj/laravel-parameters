<?php

namespace Parameter\Tests\Controller;

use Mockery;
use StdClass;
use Parameter\Tests\ControllerTest;

class ParametersControllerTest extends ControllerTest
{
	public function test_tests()
	{
        $response = $this->get('/parameters');
		$this->seeStatusCode(200);
	}

	public function test_1()
	{
        $response = $this->actingAs(new \Illuminate\Foundation\Auth\User())->json('POST', '/parameters', ['name' => 'param','category_id' => 'e']);
        $response->seeStatusCode(422);
        $responseArray = $response->decodeResponseJson();
        $this->assertArrayContains(['type','label','category_id'], array_keys($responseArray));
	}
}