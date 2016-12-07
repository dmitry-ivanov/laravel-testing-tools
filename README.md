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
