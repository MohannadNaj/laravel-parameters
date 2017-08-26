<?php

namespace Parameter\Tests\Unit;

use Mockery;
use StdClass;
use Parameter\Parameter;
use Parameter\Tests\TestCase;

class ManagerTest extends TestCase
{
	public function test_tests()
	{
        $response = $this->get('/parameters');
		$this->seeStatusCode(200);
	}

	public function test_1()
	{
        $response = $this->json('POST', '/parameters', ['name' => 'param','category_id' => 'e']);
        $response->seeStatusCode(422);
        $responseArray = $response->decodeResponseJson();
//        $this->assertEquals(['type','label','category_id'], array_keys($responseArray));
	}

	public function test_2() {
		$columns = array_values(Parameter::getColumns());
		$targetedColumns = ['id','name','label','category_id','updated_at'];

		$this->assertArrayContains($targetedColumns, $columns);
	}

	public function assertArrayContains($needles, $haystack) {
		$intersect = array_intersect($haystack, $needles);
		$needles = (array) $needles;

		asort($intersect);
		asort($needles);

		$this->assertEquals(array_values($intersect), array_values($needles));
	}
}