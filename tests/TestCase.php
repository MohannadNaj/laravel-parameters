<?php

namespace Parameter\Tests;

use Parameter\Parameter;
use Parameter\Providers\ParametersServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\BrowserKit\TestCase as OrchestraTestCase;

use Mockery;

abstract class TestCase  extends OrchestraTestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function getPackageProviders($app)
    {
        return [
            ParametersServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');

        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => $this->getTempDirectory().'/database.sqlite',
            'prefix' => '',
        ]);

        $app['config']->set('auth.providers.users.model', User::class);

        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
    }

    protected function setUpDatabase()
    {
        $this->resetDatabase();

        $this->createActivityLogTable();
    }

    protected function resetDatabase()
    {
        file_put_contents($this->getTempDirectory().'/database.sqlite', null);
    }

    protected function createActivityLogTable()
    {
        include_once '__DIR__'.'/../src/database/migrations/2017_06_20_063902_create_parameters_table.php';

        (new \CreateParametersTable())->up();
    }

    public function getTempDirectory(): string
    {
        return __DIR__.'/temp';
    }
}
