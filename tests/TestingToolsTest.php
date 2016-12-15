<?php

use Illuminated\Testing\Asserts\ArtisanAsserts;
use Illuminated\Testing\Asserts\CollectionAsserts;
use Illuminated\Testing\Asserts\DatabaseAsserts;
use Illuminated\Testing\Asserts\ExceptionAsserts;
use Illuminated\Testing\Asserts\LogFileAsserts;
use Illuminated\Testing\Asserts\PageAsserts;
use Illuminated\Testing\Asserts\ScheduleAsserts;
use Illuminated\Testing\Asserts\ServiceProviderAsserts;
use Illuminated\Testing\Asserts\TraitAsserts;
use Illuminated\Testing\Helpers\EmulatesEnvironment;
use Illuminated\Testing\Helpers\InteractsWithConsole;
use Illuminated\Testing\TestingTools;

class TestingToolsTest extends TestCase
{
    /** @test */
    public function it_is_using_all_testing_tools_helpers()
    {
        $this->assertTraitUsed(TestingTools::class, EmulatesEnvironment::class);
        $this->assertTraitUsed(TestingTools::class, InteractsWithConsole::class);
    }

    /** @test */
    public function it_is_using_all_testing_tools_asserts()
    {
        $this->assertTraitUsed(TestingTools::class, ArtisanAsserts::class);
        $this->assertTraitUsed(TestingTools::class, CollectionAsserts::class);
        $this->assertTraitUsed(TestingTools::class, DatabaseAsserts::class);
        $this->assertTraitUsed(TestingTools::class, ExceptionAsserts::class);
        $this->assertTraitUsed(TestingTools::class, LogFileAsserts::class);
        $this->assertTraitUsed(TestingTools::class, PageAsserts::class);
        $this->assertTraitUsed(TestingTools::class, ScheduleAsserts::class);
        $this->assertTraitUsed(TestingTools::class, ServiceProviderAsserts::class);
        $this->assertTraitUsed(TestingTools::class, TraitAsserts::class);
    }
}
