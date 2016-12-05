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

## Helpers List

> New helpers are always adding. Feel free to contribute.

- [InteractsWithConsole](#interactswithconsole)
  - [runConsoleCommand](#runconsolecommand)

## Asserts List

> New asserts are always adding. Feel free to contribute.

- [PageAsserts](#pageasserts)
  - [seeElementTimes](#seeelementtimes)
  - [dontSeeElementTimes](#dontseeelementtimes)

## Helpers

### InteractsWithConsole

#### `runConsoleCommand()`

Runs console command in a pure mode, via object. Returns command object:

```php
$command = $this->runConsoleCommand(MyCommand::class);
```

## Asserts

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
