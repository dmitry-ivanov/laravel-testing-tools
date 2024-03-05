![Laravel-specific Testing Helpers and Assertions](art/1380x575-optimized.jpg)

# Laravel Testing Tools
### This is a fork from the original Repository to support Laravel v10.x

---

[<img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee" style="height: 60px !important;width: 217px !important;" />](https://www.buymeacoffee.com/frank.stuhec)

[![StyleCI](https://github.styleci.io/repos/75414626/shield?branch=master&style=flat)](https://github.styleci.io/repos/75414626?branch=master)
[![Build Status](https://img.shields.io/github/workflow/status/dmitry-ivanov/laravel-testing-tools/tests/master)](https://github.com/dmitry-ivanov/laravel-testing-tools/actions?query=workflow%3Atests+branch%3Amaster)
[![Coverage Status](https://img.shields.io/codecov/c/github/dmitry-ivanov/laravel-testing-tools/master)](https://app.codecov.io/gh/dmitry-ivanov/laravel-testing-tools/branch/master)

![Packagist Version](https://img.shields.io/packagist/v/illuminated/testing-tools)
![Packagist Stars](https://img.shields.io/packagist/stars/illuminated/testing-tools)
![Packagist Downloads](https://img.shields.io/packagist/dt/illuminated/testing-tools)
![Packagist License](https://img.shields.io/packagist/l/illuminated/testing-tools)

Laravel-specific Testing Helpers and Assertions.

| Laravel | Testing Tools                                                            |
|---------|--------------------------------------------------------------------------|
| 10.x    | [10.x](https://github.com/srd2010/laravel-testing-tools/tree/10.x)       |
| 9.x     | [9.x](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/9.x)   |
| 8.x     | [8.x](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/8.x)   |
| 7.x     | [7.x](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/7.x)   |
| 6.x     | [6.x](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/6.x)   |
| 5.8.*   | [5.8.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.8) |
| 5.7.*   | [5.7.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.7) |
| 5.6.*   | [5.6.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.6) |
| 5.5.*   | [5.5.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.5) |
| 5.4.*   | [5.4.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.4) |
| 5.3.*   | [5.3.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.3) |
| 5.2.*   | [5.2.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.2) |
| 5.1.*   | [5.1.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.1) |

## Usage

1. Install the package via Composer:

    ```shell script
    composer require --dev illuminated/testing-tools
    ```

2. Use `Illuminated\Testing\TestingTools` trait:

    ```php
    use Illuminated\Testing\TestingTools;

    abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
    {
        use TestingTools;

        // ...
    }
    ```

3. Use any of the provided helpers and assertions in your tests:

    ```php
    class ExampleTest extends TestCase
    {
        /** @test */
        public function it_has_lots_of_useful_assertions()
        {
            $this->assertDatabaseHasMany('posts', [
                ['title' => 'Awesome!'],
                ['title' => 'Check multiple rows'],
                ['title' => 'In one simple assertion 🤟'],
            ]);
        }
    }
    ```

## Available helpers

> Feel free to contribute.

- [ApplicationHelpers](#applicationhelpers)
  - [emulateLocal](#emulatelocal)
  - [emulateProduction](#emulateproduction)
  - [emulateEnvironment](#emulateenvironment)

## Available assertions

> Feel free to contribute.

- [CollectionAsserts](#collectionasserts)
  - [assertCollectionsEqual](#assertcollectionsequal)
  - [assertCollectionsNotEqual](#assertcollectionsnotequal)
- [DatabaseAsserts](#databaseasserts)
  - [assertDatabaseHasTable](#assertdatabasehastable)
  - [assertDatabaseMissingTable](#assertdatabasemissingtable)
  - [assertDatabaseHasMany](#assertdatabasehasmany)
  - [assertDatabaseMissingMany](#assertdatabasemissingmany)
- [FilesystemAsserts](#filesystemasserts)
  - [assertDirectoryEmpty](#assertdirectoryempty)
  - [assertDirectoryNotEmpty](#assertdirectorynotempty)
  - [assertFilesCount](#assertfilescount)
  - [assertNotFilesCount](#assertnotfilescount)
- [LogFileAsserts](#logfileasserts)
  - [seeLogFile](#seelogfile)
  - [dontSeeLogFile](#dontseelogfile)
  - [seeInLogFile](#seeinlogfile)
  - [dontSeeInLogFile](#dontseeinlogfile)
- [ScheduleAsserts](#scheduleasserts)
  - [seeScheduleCount](#seeschedulecount)
  - [dontSeeScheduleCount](#dontseeschedulecount)
  - [seeInSchedule](#seeinschedule)
  - [dontSeeInSchedule](#dontseeinschedule)

## Helpers

### ApplicationHelpers

#### `emulateLocal()`

Emulate that application is running on the `local` environment:

```php
$this->emulateLocal();
```

#### `emulateProduction()`

Emulate that application is running on the `production` environment:

```php
$this->emulateProduction();
```

#### `emulateEnvironment()`

Emulate that application is running on the given environment:

```php
$this->emulateEnvironment('demo');
```

## Assertions

### CollectionAsserts

#### `assertCollectionsEqual()`

Assert that the given collections are equal based on the specified key:

```php
$this->assertCollectionsEqual($collection1, $collection2, 'id');
```

#### `assertCollectionsNotEqual()`

Assert that the given collections are not equal based on the specified key:

```php
$this->assertCollectionsNotEqual($collection1, $collection2, 'id');
```

### DatabaseAsserts

#### `assertDatabaseHasTable()`

Assert that the database has the given table:

```php
$this->assertDatabaseHasTable('users');
```

#### `assertDatabaseMissingTable()`

Assert that the database doesn't have the given table:

```php
$this->assertDatabaseMissingTable('unicorns');
```

#### `assertDatabaseHasMany()`

Assert that the database has all the given rows:

```php
$this->assertDatabaseHasMany('posts', [
    ['title' => 'First Post'],
    ['title' => 'Second Post'],
    ['title' => 'Third Post'],
]);
```

#### `assertDatabaseMissingMany()`

Assert that the database doesn't have all the given rows:

```php
$this->assertDatabaseMissingMany('posts', [
    ['title' => 'Fourth Post'],
    ['title' => 'Fifth Post'],
]);
```

### FilesystemAsserts

#### `assertDirectoryEmpty()`

Assert that the given directory is empty:

```php
$this->assertDirectoryEmpty('./my/dir/');
```

#### `assertDirectoryNotEmpty()`

Assert that the given directory is not empty:

```php
$this->assertDirectoryNotEmpty('./my/dir/');
```

#### `assertFilesCount()`

Assert that directory has the given number of files:

```php
$this->assertFilesCount('./my/dir/', 3);
```

#### `assertNotFilesCount()`

Assert that directory doesn't have the given number of files:

```php
$this->assertNotFilesCount('./my/dir/', 5);
```

### LogFileAsserts

#### `seeLogFile()`

Assert that the given log file exists.

The path is relative to the `storage/logs` folder:

```php
$this->seeLogFile('example.log');
```

#### `dontSeeLogFile()`

Assert that the given log file doesn't exist.

The path is relative to the `storage/logs` folder:

```php
$this->dontSeeLogFile('foobarbaz.log');
```

#### `seeInLogFile()`

Assert that the log file contains the given message.

The path is relative to the `storage/logs` folder:

```php
$this->seeInLogFile('example.log', 'Sample log message!');
```

Also, you can specify an array of messages:

```php
$this->seeInLogFile('example.log', [
    'Sample log message 1!',
    'Sample log message 2!',
    'Sample log message 3!',
]);
```

You can use these placeholders in messages:
- `%datetime%` - any datetime string.

```php
$this->seeInLogFile('example.log', '[%datetime%]: Sample log message!');
```

#### `dontSeeInLogFile()`

Assert that the log file doesn't contain the given message.

The path is relative to the `storage/logs` folder:

```php
$this->dontSeeInLogFile('example.log', 'Non-existing log message!');
```

Also, you can specify an array of messages:

```php
$this->dontSeeInLogFile('example.log', [
    'Non-existing log message 1!',
    'Non-existing log message 2!',
    'Non-existing log message 3!',
]);
```

### ScheduleAsserts

#### `seeScheduleCount()`

Assert that schedule count equals to the given value:

```php
$this->seeScheduleCount(3);
```

#### `dontSeeScheduleCount()`

Assert that schedule count doesn't equal to the given value:

```php
$this->dontSeeScheduleCount(5);
```

#### `seeInSchedule()`

Assert that the given command is scheduled:

```php
$this->seeInSchedule('foo', 'everyFiveMinutes');
$this->seeInSchedule('bar', 'hourly');
$this->seeInSchedule('baz', 'twiceDaily');
```

Also, you can use cron expressions:

```php
$this->seeInSchedule('foo', '*/5 * * * * *');
$this->seeInSchedule('bar', '0 * * * * *');
$this->seeInSchedule('baz', '0 1,13 * * * *');
```

#### `dontSeeInSchedule()`

Assert that the given command is not scheduled:

```php
$this->dontSeeInSchedule('foobarbaz');
```

## Sponsors

[![Laravel Idea](art/sponsor-laravel-idea.png)](https://laravel-idea.com)<br>
[![Material Theme UI Plugin](art/sponsor-material-theme.png)](https://material-theme.com)<br>

## License

Laravel Testing Tools is open-sourced software licensed under the [MIT license](LICENSE.md).

[<img src="https://user-images.githubusercontent.com/1286821/43086829-ff7c006e-8ea6-11e8-8b03-ecf97ca95b2e.png" alt="Support on Patreon" width="125" />](https://patreon.com/dmitryivanov)&nbsp;
[<img src="https://user-images.githubusercontent.com/1286821/181085373-12eee197-187a-4438-90fe-571ac6d68900.png" alt="Buy me a coffee" width="200" />](https://buymeacoffee.com/dmitry.ivanov)&nbsp;
