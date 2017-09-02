<?php

namespace Parameter\Tests\Controller;

use Mockery;
use StdClass;
use Parameter\Tests\User;
use Illuminate\Http\UploadedFile;
use Parameter\Tests\ControllerTest;
use Illuminate\Support\Facades\Storage;

class ParameterControllerTest extends ControllerTest
{

	public function test_validation_on_create_parameter()
	{
        $response = $this->actingAs(new User())->json('POST', '/parameters', ['name' => 'param','category_id' => 'e']);
        $response->seeStatusCode(422);
        $responseArray = $response->decodeResponseJson();
        $this->assertArrayContains(['type','label','category_id'], array_keys($responseArray));
	}

	public function test_success_create_parameter()
	{
        $response = $this->actingAs(new User())->json('POST', '/parameters', ['name' => 'param','category_id' => null, 'type'=>'text', 'label'=>'some_param']);
        $response->seeStatusCode(200);
        $responseArray = $response->decodeResponseJson();

        $this->assertArrayContains(['id','created_at'], array_keys($responseArray['parameter']));
	}

	public function test_upload_file()
    {
        Storage::fake('local');

        $response = $this->json('POST', '/parameters/addPhoto', [
            'file' => UploadedFile::fake()->image('avatar.jpg')
        ]);
		$response->seeStatusCode(200);

        $responseArray = $response->decodeResponseJson();
        Storage::disk('local')->assertExists($responseArray['path']);
    }


 	public function test_upload_validate_file()
    {

        $response = $this->json('POST', '/parameters/addPhoto', [
         'file'=>'not a file!'
        ]);
		$response->seeStatusCode(422);
    }

 	public function test_category_parameter()
    {
    	// create parameter
		$this->json('POST', '/parameters',
			['name' => 'param','category_id' => null, 'type'=>'text', 'label'=>'some_param']
		);

		// add category
		$this->json('POST', '/parameters/addCategory',
			['value'=>'category-name']
		);

		// assign parameter to category
     	$response = $this->json('POST', '/parameters/1/category/2');
		$response->seeStatusCode(200);

		$this->assertEquals(param()[0]->category->value, 'category-name');

//		$this->assertEquals('category-name,',param(1)->category);
    }
}