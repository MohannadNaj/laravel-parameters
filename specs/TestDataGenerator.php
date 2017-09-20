<?php

namespace Parameter\Tests;

use File;
use Mockery;
use StdClass;
use Parameter\Parameter;
use Faker\Factory as Faker;
use Parameter\ParameterObserver;
use Parameter\ParametersManager;
use Parameter\Tests\ModelTestCase;

class TestDataGenerator extends ModelTestCase
{
    protected $output = "testData.json"; // relative to __DIR__

    public function test_generate_test_data_for_client()
    {
        $testData = [
            'parameters' => factory(Parameter::class, 20)
                ->create()
                ->toArray(),
            'integer' => factory(Parameter::class, 3)
                ->create(['type'=>'integer'])
                ->toArray(),
            'boolean' => factory(Parameter::class, 3)
                ->create(['type'=>'boolean'])
                ->toArray(),
            'textfield' => factory(Parameter::class, 3)
                ->create(['type'=>'textfield'])
                ->toArray(),
            'text' => factory(Parameter::class, 3)
                ->create(['type'=>'text'])
                ->toArray(),
        ];

        $testData['categories'] = factory(Parameter::class, 3)
            ->create(['type'=>'textfield','is_category'=>true])->toArray();

        $testData['categorized_parameters'] = [];

        foreach ($testData['categories'] as $category) {
            $testData['categorized_parameters'] =
                array_merge(
                    $testData['categorized_parameters'] ,
                    factory(Parameter::class, 5)
                    ->create(['category_id' => $category['id']])
                    ->toArray()
                );
        }

        $outputPath = __DIR__ . '/'. $this->output;

        File::put($outputPath, json_encode($testData, JSON_PRETTY_PRINT));

        $this->assertTrue(File::exists($outputPath), 'test data is generated');
    }
}
