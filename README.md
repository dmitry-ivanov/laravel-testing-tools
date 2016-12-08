# Laravel testing tools

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/dd09a6c5-ccae-4c6b-b126-79337cbb6cec/big.png)](https://insight.sensiolabs.com/projects/dd09a6c5-ccae-4c6b-b126-79337cbb6cec)

[![StyleCI](https://styleci.io/repos/75414626/shield?branch=master&style=flat)](https://styleci.io/repos/75414626)
[![Build Status](https://travis-ci.org/dmitry-ivanov/laravel-testing-tools.svg?branch=master)](https://travis-ci.org/dmitry-ivanov/laravel-testing-tools)
[![Coverage Status](https://coveralls.io/repos/github/dmitry-ivanov/laravel-testing-tools/badge.svg?branch=master)](https://coveralls.io/github/dmitry-ivanov/laravel-testing-tools?branch=master)

[Latest Stable Version]
[Latest Unstable Version]
[Total Downloads]
[License]

Provides Laravel-specific testing helpers and asserts.

## Requirements

- `PHP >=5.6.4`
- `Laravel >=5.2`

## Available helpers

> New helpers are always adding. Feel free to contribute.

- [EmulatesEnvironment](#emulatesenvironment)
  - [emulateLocal](#emulatelocal)
  - [emulateProduction](#emulateproduction)
- [InteractsWithConsole](#interactswithconsole)
  - [runConsoleCommand](#runconsolecommand)

## Available asserts

> New asserts are always adding. Feel free to contribute.

- [CollectionAsserts](#collectionasserts)
  - [assertEqualCollections](#assertequalcollections)
  - [assertNotEqualCollections](#assertnotequalcollections)
- [LogFileAsserts](#logfileasserts)
  - [assertLogFileExists](#assertlogfileexists)
  - [assertLogFileNotExists](#assertlogfilenotexists)
  - [assertLogFileContains](#assertlogfilecontains)
  - [assertLogFileNotContains](#assertlogfilenotcontains)
- [PageAsserts](#pageasserts)
  - [seeElementTimes](#seeelementtimes)
  - [dontSeeElementTimes](#dontseeelementtimes)
- [ScheduleAsserts](#scheduleasserts)
  - [assertScheduleCount](#assertschedulecount)
  - [assertNotScheduleCount](#assertnotschedulecount)
  - [seeInSchedule](#seeinschedule)
  - [dontSeeInSchedule](#dontseeinschedule)

## Helpers

### EmulatesEnvironment

#### `emulateLocal()`

Emulates that application is working at `local` environment:

```php
$this->emulateLocal();
```

#### `emulateProduction()`

Emulates that application is working at `production` environment:

```php
$this->emulateProduction();
```

### InteractsWithConsole

#### `runConsoleCommand()`

Runs console command by the direct `run` method call, through the object. Returns command object:

```php
$command = $this->runConsoleCommand(MyCommand::class);
```

## Asserts

### CollectionAsserts

#### `assertEqualCollections()`

Checks if passed collections are equal according to the specified key:

```php
$this->assertEqualCollections($collection1, $collection2, 'id');
```

#### `assertNotEqualCollections()`

Checks if passed collections are not equal according to the specified key:

```php
$this->assertNotEqualCollections($collection1, $collection2, 'id');
```

### LogFileAsserts

#### `assertLogFileExists()`

Checks if log file exists by specified path. Path is relative to `storage/logs` folder:

```php
$this->assertLogFileExists('example.log');
```

#### `assertLogFileNotExists()`

Checks if log file not exists by specified path. Path is relative to `storage/logs` folder:

```php
$this->assertLogFileNotExists('foobar.log');
```

#### `assertLogFileContains()`

Checks if log file contains specified content. Path is relative to `storage/logs` folder.

```php
$this->assertLogFileContains('example.log', 'Sample log message 1!');
```

Or you can pass an array of expected content items:

```php
$this->assertLogFileContains('example.log', [
    'Sample log message 1!',
    'Sample log message 2!',
    'Sample log message 3!',
]);
```

These placeholders are also available for content:
- `%datetime%` - any datetime string.

```php
$this->assertLogFileContains('example.log', '[%datetime%]: Sample log message 1!');
```

#### `assertLogFileNotContains()`

Checks if log file not contains specified content. Path is relative to `storage/logs` folder.

```php
$this->assertLogFileNotContains('example.log', 'Sample log message 111!');
```

Or you can pass an array of unexpected content items:

```php
$this->assertLogFileNotContains('example.log', [
    'Sample log message 111!',
    'Sample log message 222!',
    'Sample log message 333!',
]);
```

### PageAsserts

#### `seeElementTimes()`

Checks if specified element seen on the page exact number of times:

```php
$this->seeElementTimes('.body-item', 3);
```

#### `dontSeeElementTimes()`

Checks if specified element not seen on the page exact number of times:

```php
$this->dontSeeElementTimes('.body-item', 5);
```

### ScheduleAsserts

#### `assertScheduleCount()`

Checks that schedule events count is exactly as expected:

```php
$this->assertScheduleCount(3);
```

#### `assertNotScheduleCount()`

Checks that schedule events count is not exactly as expected:

```php
$this->assertNotScheduleCount(5);
```

#### `seeInSchedule()`

Checks that command is in schedule. Expressions can be the same as schedule event methods:

```php
$this->seeInSchedule('foo', 'everyFiveMinutes');
$this->seeInSchedule('bar', 'hourly');
$this->seeInSchedule('baz', 'twiceDaily');
```

Also you can pass pure cron expressions if you wish:

```php
$this->seeInSchedule('foo', '*/5 * * * * *');
$this->seeInSchedule('bar', '0 * * * * *');
$this->seeInSchedule('baz', '0 1,13 * * * *');
```

#### `dontSeeInSchedule()`

Checks that command is not in schedule.

```php
$this->dontSeeInSchedule('foobarbaz');
```
