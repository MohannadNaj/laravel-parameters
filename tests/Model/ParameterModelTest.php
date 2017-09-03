<?php

namespace Parameter\Tests\Model;

use Mockery;
use StdClass;
use Parameter\Parameter;
use Parameter\Tests\ModelTest;
use Parameter\ParameterObserver;

class ParameterModelTest extends ModelTest
{
	public function test_parameter_contains_columns_for_frontend() {
		$columns = Parameter::getColumns();
		$essentialColumns = [
			'id', 'name', 'label', 'type','meta',
			'is_category', 'category_id', 'value'];
		$this->assertArrayContains($essentialColumns, $columns);
	}

	public function test_values_casts_properly() {
		Parameter::create(
			['name'=>'param_1','type'=>'boolean','label'=>'hmmm','value'=>true]
		);

		Parameter::create(
			['name'=>'param_2','type'=>'integer','label'=>'hmmm','value'=>2]
		);

		Parameter::create(
			['name'=>'param_3','type'=>'textfield','label'=>'hmmm','value'=>3]
		);

		Parameter::create(
			['name'=>'param_4','type'=>'text','label'=>'hmmm','value'=>4]
		);

		$this->assertSame(true, param(1) );

		$this->assertSame(2, param(2) );

		$this->assertSame("3", param(3) );

		$this->assertSame("4", param(4) );
	}

	public function test_parameter_observer_is_called() {
		$observer = Mockery::mock(ParameterObserver::class);
		$observer
		->shouldReceive('saving')
		->times(2)
		->shouldReceive('saved')
		->times(2)
		->shouldReceive('updating')
		->once()
		->shouldReceive('updated')
		->once()
		->shouldReceive('deleting')
		->once()
		->shouldReceive('deleted')
		->once();

		 
		 app()->bind(ParameterObserver::class, function() use ($observer) {
	        return $observer;
	    });

		$parameter = Parameter::create(['name'=>'param_1','type'=>'boolean','label'=>'hmmm','value'=>true]);

		$parameter->value = false;
		$parameter->save();

		$parameter->delete();

//		$this->assertEquals(0 , param()->count() );
	}
}