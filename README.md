# Laravel testing tools

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/dd09a6c5-ccae-4c6b-b126-79337cbb6cec/big.png)](https://insight.sensiolabs.com/projects/dd09a6c5-ccae-4c6b-b126-79337cbb6cec)

[![StyleCI](https://styleci.io/repos/75414626/shield?branch=master&style=flat)](https://styleci.io/repos/75414626)
[![Build Status](https://travis-ci.org/dmitry-ivanov/laravel-testing-tools.svg?branch=master)](https://travis-ci.org/dmitry-ivanov/laravel-testing-tools)
[![Coverage Status](https://coveralls.io/repos/github/dmitry-ivanov/laravel-testing-tools/badge.svg?branch=master)](https://coveralls.io/github/dmitry-ivanov/laravel-testing-tools?branch=master)

[![Latest Stable Version](https://poser.pugx.org/illuminated/testing-tools/v/stable)](https://packagist.org/packages/illuminated/testing-tools)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/testing-tools/v/unstable)](https://packagist.org/packages/illuminated/testing-tools)
[![Total Downloads](https://poser.pugx.org/illuminated/testing-tools/downloads)](https://packagist.org/packages/illuminated/testing-tools)
[![License](https://poser.pugx.org/illuminated/testing-tools/license)](https://packagist.org/packages/illuminated/testing-tools)

Provides Laravel-specific testing helpers and asserts.

## Requirements

- `PHP >=5.6.4`
- `Laravel >=5.2`

## Usage

1. Install package through `composer`:

    ```shell
    composer require illuminated/testing-tools --dev
    ```

2. Use `Illuminated\Testing\TestingTools` in your `TestCase` class:

    ```php
    use Illuminated\Testing\TestingTools;

    abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
    {
        use TestingTools;

        // ...
    }
    ```

3. That's it! Now you can use any of provided helpers and asserts in your tests:

    ```php
    class HomePageTest extends TestCase
    {
        /** @test */
        public function it_shows_three_featured_products()
        {
            $this->visit('/');

            $this->seeElementTimes('.featured-product', 3);
        }
    }
    ```

## Available helpers

> New helpers are always adding. Feel free to contribute.

- [ApplicationHelpers](#applicationhelpers)
  - [emulateLocal](#emulatelocal)
  - [emulateProduction](#emulateproduction)
  - [emulateEnvironment](#emulateenvironment)
- [ArtisanHelpers](#artisanhelpers)
  - [runArtisan](#runartisan)

## Available asserts

> New asserts are always adding. Feel free to contribute.

- [ArtisanAsserts](#artisanasserts)
  - [willSeeConfirmation](#willseeconfirmation)
  - [willNotSeeConfirmation](#willnotseeconfirmation)
  - [willGiveConfirmation](#willgiveconfirmation)
  - [willNotGiveConfirmation](#willnotgiveconfirmation)
  - [seeArtisanOutput](#seeartisanoutput)
  - [dontSeeArtisanOutput](#dontseeartisanoutput)
  - [seeArtisanTableOutput](#seeartisantableoutput)
  - [dontSeeArtisanTableOutput](#dontseeartisantableoutput)
  - [seeArtisanTableRowsCount](#seeartisantablerowscount)
  - [dontSeeArtisanTableRowsCount](#dontseeartisantablerowscount)
- [CollectionAsserts](#collectionasserts)
  - [assertCollectionsEqual](#assertcollectionsequal)
  - [assertCollectionsNotEqual](#assertcollectionsnotequal)
- [DatabaseAsserts](#databaseasserts)
  - [seeInDatabaseMany](#seeindatabasemany)
  - [dontSeeInDatabaseMany](#dontseeindatabasemany)
- [ExceptionAsserts](#exceptionasserts)
  - [willSeeException](#willseeexception)
- [FilesystemAsserts](#filesystemasserts)
  - [assertDirectoryEmpty](#assertdirectoryempty)
  - [assertDirectoryNotEmpty](#assertdirectorynotempty)
  - [assertFilesCount](#assertfilescount)
  - [assertNotFilesCount](#assertnotfilescount)
- [LogFileAsserts](#logfileasserts)
  - [assertLogFileExists](#assertlogfileexists)
  - [assertLogFileNotExists](#assertlogfilenotexists)
  - [assertLogFileContains](#assertlogfilecontains)
  - [assertLogFileNotContains](#assertlogfilenotcontains)
- [PageAsserts](#pageasserts)
  - [seeElementTimes](#seeelementtimes)
  - [dontSeeElementTimes](#dontseeelementtimes)
- [ReflectionAsserts](#reflectionasserts)
  - [assertSubclassOf](#assertsubclassof)
  - [assertNotSubclassOf](#assertnotsubclassof)
  - [assertTraitUsed](#asserttraitused)
  - [assertTraitNotUsed](#asserttraitnotused)
- [ScheduleAsserts](#scheduleasserts)
  - [assertScheduleCount](#assertschedulecount)
  - [assertNotScheduleCount](#assertnotschedulecount)
  - [seeInSchedule](#seeinschedule)
  - [dontSeeInSchedule](#dontseeinschedule)
- [ServiceProviderAsserts](#serviceproviderasserts)
  - [assertAliasRegistered](#assertaliasregistered)
  - [assertAliasNotRegistered](#assertaliasnotregistered)
  - [assertCommandRegistered](#assertcommandregistered)
  - [assertCommandNotRegistered](#assertcommandnotregistered)

## Helpers

### ApplicationHelpers

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

#### `emulateEnvironment()`

Emulates that application is working at specified environment:

```php
$this->emulateEnvironment('space');
```

### ArtisanHelpers

#### `runArtisan()`

Runs artisan command directly by the class name, and return it:

```php
$command = $this->runArtisan(MyCommand::class, ['--name' => 'John']);
```

Also, you can run artisan command via command object directly:

```php
$command = $this->runArtisan(new MyCommand, ['--name' => 'Jane']);
```

## Asserts

### ArtisanAsserts

#### `willSeeConfirmation()`

Checks if confirmation is seen during artisan command execution:

```php
$this->willSeeConfirmation('Are you sure?', MyCommand::class);
```

#### `willNotSeeConfirmation()`

Checks if confirmation is not seen during artisan command execution:

```php
$this->willNotSeeConfirmation('Are you sure?', MyCommand::class);
```

#### `willGiveConfirmation()`

Checks if confirmation is seen during artisan command execution and accepts it:

```php
$this->willGiveConfirmation('Are you sure?', MyCommand::class);

$this->seeArtisanOutput('Done!');
```

#### `willNotGiveConfirmation()`

Checks if confirmation is seen during artisan command execution and refuses it:

```php
$this->willNotGiveConfirmation('Are you sure?', MyCommand::class);

$this->dontSeeArtisanOutput('Done!');
```

#### `seeArtisanOutput()`

Checks if specified string is seen as artisan output:

```php
$this->seeArtisanOutput('Hello, World!');
```

Also, path to text file containing output can be provided:

```php
$this->seeArtisanOutput('correct.output.txt');
```

#### `dontSeeArtisanOutput()`

Checks if specified string is not seen as artisan output:

```php
$this->dontSeeArtisanOutput('Hello, Universe!');
```

Also, path to text file containing output can be provided:

```php
$this->dontSeeArtisanOutput('incorrect.output.txt');
```

#### `seeArtisanTableOutput()`

Checks if specified data is seen as artisan table output:

```php
$this->seeArtisanTableOutput([
    ['System' => 'Node-1', 'Status' => 'Enabled'],
    ['System' => 'Node-2', 'Status' => 'Enabled'],
    ['System' => 'Node-3', 'Status' => 'Enabled'],
]);
```

#### `dontSeeArtisanTableOutput()`

Checks if specified data is not seen as artisan table output:

```php
$this->dontSeeArtisanTableOutput([
    ['System' => 'Node-1', 'Status' => 'Disabled'],
    ['System' => 'Node-2', 'Status' => 'Disabled'],
    ['System' => 'Node-3', 'Status' => 'Disabled'],
]);
```

#### `seeArtisanTableRowsCount()`

Checks if artisan output table rows count equals to specified value:

```php
$this->seeArtisanTableRowsCount(3);
```

#### `dontSeeArtisanTableRowsCount()`

Checks if artisan output table rows count not equals to specified value:

```php
$this->dontSeeArtisanTableRowsCount(5);
```

### CollectionAsserts

#### `assertCollectionsEqual()`

Checks if passed collections are equal according to the specified key:

```php
$this->assertCollectionsEqual($collection1, $collection2, 'id');
```

#### `assertCollectionsNotEqual()`

Checks if passed collections are not equal according to the specified key:

```php
$this->assertCollectionsNotEqual($collection1, $collection2, 'id');
```

### DatabaseAsserts

#### `seeInDatabaseMany()`

Checks if each of the specified rows exists in database:

```php
$this->seeInDatabaseMany('posts', [
    ['title' => 'First Post'],
    ['title' => 'Second Post'],
    ['title' => 'Third Post'],
]);
```

#### `dontSeeInDatabaseMany()`

Checks if each of the specified rows is not exist in database:

```php
$this->dontSeeInDatabaseMany('posts', [
    ['title' => 'Fourth Post'],
    ['title' => 'Fifth Post'],
]);
```

### ExceptionAsserts

#### `willSeeException()`

Adds expectation that exception of the specified class, with specified message and specified code will be thrown:

```php
$this->willSeeException(RuntimeException::class, 'Oops! Houston, we have a problem!');
```

### FilesystemAsserts

#### `assertDirectoryEmpty()`

Checks if specified directory is empty:

```php
$this->assertDirectoryEmpty('./some/folder');
```

#### `assertDirectoryNotEmpty()`

Checks if specified directory is not empty:

```php
$this->assertDirectoryNotEmpty('./some/folder');
```

#### `assertFilesCount()`

Checks if specified directory has specified number of files:

```php
$this->assertFilesCount('./some/folder', 3);
```

#### `assertNotFilesCount()`

Checks if specified directory not has specified number of files:

```php
$this->assertNotFilesCount('./some/folder', 5);
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
$this->assertLogFileNotExists('foobarbaz.log');
```

#### `assertLogFileContains()`

Checks if log file contains specified content. Path is relative to `storage/logs` folder.

```php
$this->assertLogFileContains('example.log', 'Sample log message!');
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
$this->assertLogFileContains('example.log', '[%datetime%]: Sample log message!');
```

#### `assertLogFileNotContains()`

Checks if log file not contains specified content. Path is relative to `storage/logs` folder.

```php
$this->assertLogFileNotContains('example.log', 'Unexisting log message!');
```

Or you can pass an array of unexpected content items:

```php
$this->assertLogFileNotContains('example.log', [
    'Unexisting log message 1!',
    'Unexisting log message 2!',
    'Unexisting log message 3!',
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

### ReflectionAsserts

#### `assertSubclassOf()`

Checks that class is subclass of specified parent class:

```php
$this->assertSubclassOf(Post::class, Model::class);
```

#### `assertNotSubclassOf()`

Checks that class is not subclass of specified parent class:

```php
$this->assertNotSubclassOf(Post::class, Command::class);
```

#### `assertTraitUsed()`

Checks that class is using specified trait:

```php
$this->assertTraitUsed(User::class, Notifiable::class);
```

#### `assertTraitNotUsed()`

Checks that class is not using specified trait:

```php
$this->assertTraitNotUsed(Post::class, Notifiable::class);
```

### ScheduleAsserts

#### `assertScheduleCount()`

Checks that schedule events count is exactly as specified:

```php
$this->assertScheduleCount(3);
```

#### `assertNotScheduleCount()`

Checks that schedule events count is not exactly as specified:

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

Checks that command is not in schedule:

```php
$this->dontSeeInSchedule('foobarbaz');
```

### ServiceProviderAsserts

#### `assertAliasRegistered()`

Checks that specified alias was successfully registered by alias loader:

```php
$this->assertAliasRegistered('Acme\Alias\Post');
```

#### `assertAliasNotRegistered()`

Checks that specified alias was not registered by alias loader:

```php
$this->assertAliasNotRegistered('Acme\Alias\Fake');
```

#### `assertCommandRegistered()`

Checks that specified command was successfully registered by service provider:

```php
$this->assertCommandRegistered('do-something');
```

#### `assertCommandNotRegistered()`

Checks that specified command was not registered by service provider:

```php
$this->assertCommandNotRegistered('fake');
```
