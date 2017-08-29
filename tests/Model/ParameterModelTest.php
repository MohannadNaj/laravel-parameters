<?php

namespace Parameter\Tests\Model;

use Mockery;
use StdClass;
use Parameter\Parameter;
use Parameter\Tests\ModelTest;

class ParameterModelTest extends ModelTest
{
	public function test_2() {
		$columns = Parameter::getColumns();
		$targetedColumns = ['id','name','label','category_id','updated_at'];
		$this->assertArrayContains($targetedColumns, $columns);
	}
}