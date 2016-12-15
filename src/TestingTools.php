<?php

namespace Illuminated\Testing;

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

trait TestingTools
{
    // Helpers
    use EmulatesEnvironment;
    use InteractsWithConsole;

    // Asserts
    use ArtisanAsserts;
    use CollectionAsserts;
    use DatabaseAsserts;
    use ExceptionAsserts;
    use LogFileAsserts;
    use PageAsserts;
    use ScheduleAsserts;
    use ServiceProviderAsserts;
    use TraitAsserts;
}
