# Laravel Testing Tools

[<img src="https://user-images.githubusercontent.com/1286821/43083932-4915853a-8ea0-11e8-8983-db9e0f04e772.png" alt="Become a Patron" width="160" />](https://patreon.com/dmitryivanov)

[![StyleCI](https://styleci.io/repos/75414626/shield?branch=7.x&style=flat)](https://styleci.io/repos/75414626)
[![Build Status](https://travis-ci.org/dmitry-ivanov/laravel-testing-tools.svg?branch=7.x)](https://travis-ci.org/dmitry-ivanov/laravel-testing-tools)
[![Coverage Status](https://coveralls.io/repos/github/dmitry-ivanov/laravel-testing-tools/badge.svg?branch=7.x)](https://coveralls.io/github/dmitry-ivanov/laravel-testing-tools?branch=7.x)

[![Latest Stable Version](https://poser.pugx.org/illuminated/testing-tools/v/stable)](https://packagist.org/packages/illuminated/testing-tools)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/testing-tools/v/unstable)](https://packagist.org/packages/illuminated/testing-tools)
[![Total Downloads](https://poser.pugx.org/illuminated/testing-tools/downloads)](https://packagist.org/packages/illuminated/testing-tools)
[![License](https://poser.pugx.org/illuminated/testing-tools/license)](https://packagist.org/packages/illuminated/testing-tools)

Laravel-specific Testing Helpers and Assertions.

| Laravel | Testing Tools                                                            |
| ------- | :----------------------------------------------------------------------: |
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
    composer require --dev "illuminated/testing-tools:^7.0"
    ```

2. Use `Illuminated\Testing\TestingTools` and disable `$mockConsoleOutput`:

    ```php
    use Illuminated\Testing\TestingTools;

    abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
    {
        use TestingTools;

        public $mockConsoleOutput = false;

        // ...
    }
    ```

3. Use any of the provided helpers and assertions in your tests:

    ```php
    class HelloCommandTest extends TestCase
    {
        /** @test */
        public function it_outputs_hello_world()
        {
            $this->artisan('hello');

            $this->seeArtisanOutput('Hello, World!');
        }
    }
    ```

## Available helpers

> Feel free to contribute.

- [ApplicationHelpers](#applicationhelpers)
  - [emulateLocal](#emulatelocal)
  - [emulateProduction](#emulateproduction)
  - [emulateEnvironment](#emulateenvironment)
  - [isTravis](#istravis)
- [ArtisanHelpers](#artisanhelpers)
  - [runArtisan](#runartisan)

## Available assertions

> Feel free to contribute.

- [ArtisanAsserts](#artisanasserts)
  - [willSeeConfirmation](#willseeconfirmation)
  - [willNotSeeConfirmation](#willnotseeconfirmation)
  - [willGiveConfirmation](#willgiveconfirmation)
  - [willNotGiveConfirmation](#willnotgiveconfirmation)
  - [seeArtisanOutput](#seeartisanoutput)
  - [dontSeeArtisanOutput](#dontseeartisanoutput)
  - [seeInArtisanOutput](#seeinartisanoutput)
  - [dontSeeInArtisanOutput](#dontseeinartisanoutput)
  - [seeArtisanTableOutput](#seeartisantableoutput)
  - [dontSeeArtisanTableOutput](#dontseeartisantableoutput)
  - [seeArtisanTableRowsCount](#seeartisantablerowscount)
  - [dontSeeArtisanTableRowsCount](#dontseeartisantablerowscount)
- [CollectionAsserts](#collectionasserts)
  - [assertCollectionsEqual](#assertcollectionsequal)
  - [assertCollectionsNotEqual](#assertcollectionsnotequal)
- [DatabaseAsserts](#databaseasserts)
  - [assertDatabaseHasTable](#assertdatabasehastable)
  - [assertDatabaseMissingTable](#assertdatabasemissingtable)
  - [assertDatabaseHasMany](#assertdatabasehasmany)
  - [assertDatabaseMissingMany](#assertdatabasemissingmany)
- [EloquentAsserts](#eloquentasserts)
  - [assertEloquentTableEquals](#asserteloquenttableequals)
  - [assertEloquentTableNotEquals](#asserteloquenttablenotequals)
  - [assertEloquentIsIncrementing](#asserteloquentisincrementing)
  - [assertEloquentIsNotIncrementing](#asserteloquentisnotincrementing)
  - [assertEloquentFillableEquals](#asserteloquentfillableequals)
  - [assertEloquentFillableNotEquals](#asserteloquentfillablenotequals)
  - [assertEloquentDatesEquals](#asserteloquentdatesequals)
  - [assertEloquentDatesNotEquals](#asserteloquentdatesnotequals)
  - [assertEloquentTouchesEquals](#asserteloquenttouchesequals)
  - [assertEloquentTouchesNotEquals](#asserteloquenttouchesnotequals)
  - [assertEloquentHasMany](#asserteloquenthasmany)
  - [assertEloquentHasCreateFor](#asserteloquenthascreatefor)
  - [assertEloquentHasCreateManyFor](#asserteloquenthascreatemanyfor)
  - [assertEloquentBelongsTo](#asserteloquentbelongsto)
- [ExceptionAsserts](#exceptionasserts)
  - [willSeeException](#willseeexception)
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
- [ReflectionAsserts](#reflectionasserts)
  - [assertSubclassOf](#assertsubclassof)
  - [assertNotSubclassOf](#assertnotsubclassof)
  - [assertTraitUsed](#asserttraitused)
  - [assertTraitNotUsed](#asserttraitnotused)
  - [assertMethodExists](#assertmethodexists)
  - [assertMethodNotExists](#assertmethodnotexists)
- [ScheduleAsserts](#scheduleasserts)
  - [seeScheduleCount](#seeschedulecount)
  - [dontSeeScheduleCount](#dontseeschedulecount)
  - [seeInSchedule](#seeinschedule)
  - [dontSeeInSchedule](#dontseeinschedule)
- [ServiceProviderAsserts](#serviceproviderasserts)
  - [seeRegisteredAlias](#seeregisteredalias)
  - [dontSeeRegisteredAlias](#dontseeregisteredalias)
  - [seeRegisteredCommand](#seeregisteredcommand)
  - [dontSeeRegisteredCommand](#dontseeregisteredcommand)

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

#### `isTravis()`

Check whether the application is running on Travis or not:

```php
$this->isTravis();

// true
```

### ArtisanHelpers

#### `runArtisan()`

Run the given artisan console command:

```php
$command = $this->runArtisan(MyCommand::class, ['--name' => 'John']);

// \Illuminate\Console\Command
```

Also, you can pass the command instance as a first argument:

```php
$command = $this->runArtisan(new MyCommand, ['--name' => 'Jane']);

// \Illuminate\Console\Command
```

## Assertions

### ArtisanAsserts

#### `willSeeConfirmation()`

Add expectation that the given confirmation question would be shown:

```php
$this->willSeeConfirmation('Are you sure?', MyCommand::class);
```

#### `willNotSeeConfirmation()`

Add expectation that the given confirmation question would not be shown:

```php
$this->willNotSeeConfirmation('Are you sure?', MyCommand::class);
```

#### `willGiveConfirmation()`

Add expectation that the given confirmation question would be shown, and accept it:

```php
$this->willGiveConfirmation('Are you sure?', MyCommand::class);

$this->seeArtisanOutput('Done!');
```

#### `willNotGiveConfirmation()`

Add expectation that the given confirmation question would be shown, and do not accept it:

```php
$this->willNotGiveConfirmation('Are you sure?', MyCommand::class);

$this->dontSeeArtisanOutput('Done!');
```

#### `seeArtisanOutput()`

Assert that the given artisan output is seen:

```php
$this->seeArtisanOutput('Hello, World!');
```

Also, you can specify a path to the file containing output:

```php
$this->seeArtisanOutput('correct.output.txt');
```

#### `dontSeeArtisanOutput()`

Assert that the given artisan output is not seen:

```php
$this->dontSeeArtisanOutput('Hello, Universe!');
```

Also, you can specify a path to the file containing output:

```php
$this->dontSeeArtisanOutput('incorrect.output.txt');
```

#### `seeInArtisanOutput()`

Assert that the given string is seen in the artisan output:

```php
$this->seeInArtisanOutput('Hello');
```

Also, you can specify a path to the file containing the string:

```php
$this->seeInArtisanOutput('needle.txt');
```

#### `dontSeeInArtisanOutput()`

Assert that the given string is not seen in the artisan output:

```php
$this->dontSeeInArtisanOutput('FooBar');
```

Also, you can specify a path to the file containing the string:

```php
$this->dontSeeInArtisanOutput('wrong-needle.txt');
```

#### `seeArtisanTableOutput()`

Assert that the given data is seen in the artisan table output:

```php
$this->seeArtisanTableOutput([
    ['System' => 'Node-1', 'Status' => 'Enabled'],
    ['System' => 'Node-2', 'Status' => 'Enabled'],
    ['System' => 'Node-3', 'Status' => 'Enabled'],
]);
```

#### `dontSeeArtisanTableOutput()`

Assert that the given data is not seen in the artisan table output:

```php
$this->dontSeeArtisanTableOutput([
    ['System' => 'Node-1', 'Status' => 'Disabled'],
    ['System' => 'Node-2', 'Status' => 'Disabled'],
    ['System' => 'Node-3', 'Status' => 'Disabled'],
]);
```

#### `seeArtisanTableRowsCount()`

Assert that the artisan table output has the given number of data rows:

```php
$this->seeArtisanTableRowsCount(3);
```

#### `dontSeeArtisanTableRowsCount()`

Assert that the artisan table output doesn't have the given number of data rows:

```php
$this->dontSeeArtisanTableRowsCount(5);
```

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

### EloquentAsserts

#### `assertEloquentTableEquals()`

Assert that the model's table name equals to the given value:

```php
$this->assertEloquentTableEquals(User::class, 'users');
```

#### `assertEloquentTableNotEquals()`

Assert that the model's table name doesn't equal to the given value:

```php
$this->assertEloquentTableNotEquals(User::class, 'posts');
```

#### `assertEloquentIsIncrementing()`

Assert that the model's primary key is incrementing:

```php
$this->assertEloquentIsIncrementing(Post::class);
```

#### `assertEloquentIsNotIncrementing()`

Assert that the model's primary key is not incrementing:

```php
$this->assertEloquentIsNotIncrementing(Category::class);
```

#### `assertEloquentFillableEquals()`

Assert that the model's `fillable` field equals to the given value:

```php
$this->assertEloquentFillableEquals(Post::class, ['title', 'publish_at']);
```

#### `assertEloquentFillableNotEquals()`

Assert that the model's `fillable` field doesn't equal to the given value:

```php
$this->assertEloquentFillableNotEquals(Post::class, ['title', 'body', 'publish_at']);
```

#### `assertEloquentDatesEquals()`

Assert that the model's `dates` field equals to the given value:

```php
$this->assertEloquentDatesEquals(Post::class, ['publish_at', 'created_at', 'updated_at']);
```

#### `assertEloquentDatesNotEquals()`

Assert that the model's `dates` field doesn't equal to the given value:

```php
$this->assertEloquentDatesNotEquals(Post::class, ['publish_at']);
```

#### `assertEloquentTouchesEquals()`

Assert that the model's `touches` field equals to the given value:

```php
$this->assertEloquentTouchesEquals(Comment::class, ['post']);
```

#### `assertEloquentTouchesNotEquals()`

Assert that the model's `touches` field doesn't equal to the given value:

```php
$this->assertEloquentTouchesNotEquals(Comment::class, ['user']);
```

#### `assertEloquentHasMany()`

> NOTE: To use this assertion, you have to create model factories for both classes.

Assert that the model has the given `HasMany` relation:

```php
$this->assertEloquentHasMany(Post::class, 'comments');
```

Assuming that `Post` class has `comments` relation:

```php
class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
```

#### `assertEloquentHasCreateFor()`

> NOTE: To use this assertion, you have to create model factories for both classes.

Assert that the model has `create` method for the given `HasMany` relation:

```php
$this->assertEloquentHasCreateFor(Post::class, 'comments');
```

Assuming that `Post` class has `createComment()` method:

```php
class Post extends Model
{
    public function createComment(array $attributes)
    {
        return $this->comments()->create($attributes);
    }
}
```

#### `assertEloquentHasCreateManyFor()`

> NOTE: To use this assertion, you have to create model factories for both classes.

Assert that the model has `createMany` method for the given `HasMany` relation:

```php
$this->assertEloquentHasCreateManyFor(Post::class, 'comments');
```

Assuming that `Post` class has `createManyComments()` method:

```php
class Post extends Model
{
    public function createManyComments(array $comments)
    {
        return $this->comments()->createMany($comments);
    }
}
```

#### `assertEloquentBelongsTo()`

> NOTE: To use this assertion, you have to create model factories for both classes.

Assert that the model has the given `BelongsTo` relation:

```php
$this->assertEloquentBelongsTo(Comment::class, 'post');
```

Assuming that `Comment` class has `post` relation:

```php
class Comment extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
```

### ExceptionAsserts

#### `willSeeException()`

Add expectation that the given exception would be thrown:

```php
$this->willSeeException(RuntimeException::class, 'Oops! Houston, we have a problem!');
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

### ReflectionAsserts

#### `assertSubclassOf()`

Assert that class is a subclass of the given parent:

```php
$this->assertSubclassOf(Post::class, Model::class);
```

#### `assertNotSubclassOf()`

Assert that class is not a subclass of the given parent:

```php
$this->assertNotSubclassOf(Post::class, Command::class);
```

#### `assertTraitUsed()`

Assert that class uses the given trait:

```php
$this->assertTraitUsed(User::class, Notifiable::class);
```

#### `assertTraitNotUsed()`

Assert that class doesn't use the given trait:

```php
$this->assertTraitNotUsed(Post::class, Notifiable::class);
```

#### `assertMethodExists()`

Assert that object has the given method:

```php
$this->assertMethodExists(Post::class, 'save');
```

#### `assertMethodNotExists()`

Assert that object doesn't have the given method:

```php
$this->assertMethodNotExists(Post::class, 'fly');
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

### ServiceProviderAsserts

#### `seeRegisteredAlias()`

Assert that the given alias is registered:

```php
$this->seeRegisteredAlias('Twitter');
```

#### `dontSeeRegisteredAlias()`

Assert that the given alias is not registered:

```php
$this->dontSeeRegisteredAlias('FooBarBaz');
```

#### `seeRegisteredCommand()`

Assert that the given command is registered:

```php
$this->seeRegisteredCommand('my-command');
```

#### `dontSeeRegisteredCommand()`

Assert that the given command is not registered:

```php
$this->dontSeeRegisteredCommand('foobarbaz');
```

## License

Laravel Testing Tools is open-sourced software licensed under the [MIT license](LICENSE.md).

[<img src="https://user-images.githubusercontent.com/1286821/43086829-ff7c006e-8ea6-11e8-8b03-ecf97ca95b2e.png" alt="Support on Patreon" width="125" />](https://patreon.com/dmitryivanov)
