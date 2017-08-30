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

	public function test_upload_file()
    {
        Storage::fake('local');

        $response = $this->json('POST', '/parameters/addPhoto', [
            'file' => UploadedFile::fake()->image('avatar.jpg')
        ]);

		$responseArray = $response->decodeResponseJson();
		print_r($responseArray);

        Storage::disk('local')->assertExists($responseArray['path']);
    }
}