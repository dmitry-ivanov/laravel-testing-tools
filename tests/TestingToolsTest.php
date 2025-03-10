<?php

namespace Illuminated\Testing\Tests;

use Illuminated\Testing\Asserts\CollectionAsserts;
use Illuminated\Testing\Asserts\DatabaseAsserts;
use Illuminated\Testing\Asserts\FilesystemAsserts;
use Illuminated\Testing\Asserts\LogFileAsserts;
use Illuminated\Testing\Asserts\ScheduleAsserts;
use Illuminated\Testing\Helpers\ApplicationHelpers;
use Illuminated\Testing\TestingTools;
use PHPUnit\Framework\Attributes\Test;

class TestingToolsTest extends TestCase
{
    #[Test]
    public function it_is_using_all_testing_tools_helpers(): void
    {
        $this->assertTraitUsed(TestingTools::class, ApplicationHelpers::class);
    }

    #[Test]
    public function it_is_using_all_testing_tools_asserts(): void
    {
        $this->assertTraitUsed(TestingTools::class, CollectionAsserts::class);
        $this->assertTraitUsed(TestingTools::class, DatabaseAsserts::class);
        $this->assertTraitUsed(TestingTools::class, FilesystemAsserts::class);
        $this->assertTraitUsed(TestingTools::class, LogFileAsserts::class);
        $this->assertTraitUsed(TestingTools::class, ScheduleAsserts::class);
    }
}
