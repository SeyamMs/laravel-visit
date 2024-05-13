<?php

namespace SeyamMs\LaravelVisit\Tests;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;
use SeyamMs\LaravelVisit\Tests\TestModels\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use SeyamMs\LaravelVisit\LaravelVisitServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected $testPage;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelVisitServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__ . '/../database/migrations/create_visits_table.php.stub';
        $migration->up();
    }

    protected function setUpDatabase($app)
    {
        $schema = $app['db']->connection()->getSchemaBuilder();

        $schema->create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });

        $this->testPage = Page::create(['title' => str(20)]);
    }
}
