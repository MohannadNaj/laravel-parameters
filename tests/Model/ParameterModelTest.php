<?php

namespace Parameter\Tests\Model;

use Mockery;
use StdClass;
use Parameter\Parameter;
use Parameter\Tests\ModelTest;

class ParameterModelTest extends ModelTest
{
	public function test_parameter_contains_columns_for_frontend() {
		$columns = Parameter::getColumns();
		$targetedColumns = ['id','value','name','label','category_id','updated_at'];
		$this->assertArrayContains($targetedColumns, $columns);
	}
	public function test_values_casts_properly() {
		Parameter::create(
			['name'=>'moh','type'=>'boolean','label'=>'hmmm','value'=>true]
		);

		Parameter::create(
			['name'=>'moh_','type'=>'integer','label'=>'hmmm','value'=>3]
		);

		$this->assertSame(3, param(2) );
	}
}