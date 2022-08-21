<?php

namespace Illuminated\Testing;

use Illuminated\Testing\Asserts\CollectionAsserts;
use Illuminated\Testing\Asserts\DatabaseAsserts;
use Illuminated\Testing\Asserts\FilesystemAsserts;
use Illuminated\Testing\Asserts\LogFileAsserts;
use Illuminated\Testing\Asserts\ReflectionAsserts;
use Illuminated\Testing\Asserts\ScheduleAsserts;
use Illuminated\Testing\Asserts\ServiceProviderAsserts;
use Illuminated\Testing\Helpers\ApplicationHelpers;

trait TestingTools
{
    /** Helpers */
    use ApplicationHelpers;

    /** Asserts */
    use CollectionAsserts;
    use DatabaseAsserts;
    use FilesystemAsserts;
    use LogFileAsserts;
    use ReflectionAsserts;
    use ScheduleAsserts;
    use ServiceProviderAsserts;
}
