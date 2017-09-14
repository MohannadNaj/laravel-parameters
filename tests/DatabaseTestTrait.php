<?php

namespace Parameter\Tests;

trait DatabaseTestTrait
{
    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function setUpDatabase()
    {
        $this->resetDatabase();

        $this->createParametersTable();
        $this->withFactories(__DIR__.'/_database/factories/');
    }

    protected function resetDatabase()
    {
        file_put_contents($this->getTempDirectory().'/database.sqlite', null);
    }

    protected function createParametersTable()
    {
        include_once __DIR__.'/../src/database/migrations/2017_06_20_063902_create_parameters_table.php';

        (new \CreateParametersTable())->up();
    }
}
