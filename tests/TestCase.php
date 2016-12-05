<?php

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->setUpViews();
        $this->setUpRoutes();
    }

    private function setUpViews()
    {
        app('view')->addLocation(__DIR__ . '/fixture/resources/views');
    }

    private function setUpRoutes()
    {
        app('router')->get('/', 'HomeController@index');
    }
}
