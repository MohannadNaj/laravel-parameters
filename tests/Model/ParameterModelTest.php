<?php

namespace Parameter\Tests\Model;

use Mockery;
use StdClass;
use Parameter\Parameter;
use Faker\Factory as Faker;
use Parameter\Tests\ModelTestCase;
use Parameter\ParameterObserver;

class ParameterModelTestCase extends ModelTestCase
{
	public function test_parameter_contains_columns_for_frontend() {
		$columns = Parameter::getColumns();
		$essentialColumns = [
			'id', 'name', 'label', 'type','meta',
			'is_category', 'category_id', 'value'];
		$this->assertArrayContains($essentialColumns, $columns);
	} 

	public function test_values_casts_properly() {

		factory(Parameter::class)->create(['type'=>'boolean', 'value'=>true]);

		factory(Parameter::class)->create(['type'=>'integer', 'value'=>2]);

		factory(Parameter::class)->create(['type'=>'textfield', 'value'=>3]);

		factory(Parameter::class)->create(['type'=>'text', 'value'=>4]);

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

		$parameter = factory(Parameter::class)->create(['type'=>'boolean', 'value'=>true]);

		$parameter->value = false;
		$parameter->save();

		$parameter->delete();
	}

	public function test_parameters_signleton_is_up2date()
	{
		factory(Parameter::class, 5)->create();

		$this->assertEquals(5 , param()->count() );

		param()->random()->delete();
		param()->random()->delete();

		$this->assertEquals(3 , param()->count() );
	
		$parameter = factory(Parameter::class)->create(['type'=>'integer']);
		dd(param()->last()->value);
		$parameter->value = 55;

	}
}