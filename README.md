# Laravel Testing Tools

[<img src="https://user-images.githubusercontent.com/1286821/43083932-4915853a-8ea0-11e8-8983-db9e0f04e772.png" alt="Become a Patron" width="160" />](https://www.patreon.com/illuminated)

[![StyleCI](https://styleci.io/repos/75414626/shield?branch=5.7&style=flat)](https://styleci.io/repos/75414626)
[![Build Status](https://travis-ci.org/dmitry-ivanov/laravel-testing-tools.svg?branch=5.7)](https://travis-ci.org/dmitry-ivanov/laravel-testing-tools)
[![Coverage Status](https://coveralls.io/repos/github/dmitry-ivanov/laravel-testing-tools/badge.svg?branch=5.7)](https://coveralls.io/github/dmitry-ivanov/laravel-testing-tools?branch=5.7)

[![Latest Stable Version](https://poser.pugx.org/illuminated/testing-tools/v/stable)](https://packagist.org/packages/illuminated/testing-tools)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/testing-tools/v/unstable)](https://packagist.org/packages/illuminated/testing-tools)
[![Total Downloads](https://poser.pugx.org/illuminated/testing-tools/downloads)](https://packagist.org/packages/illuminated/testing-tools)
[![License](https://poser.pugx.org/illuminated/testing-tools/license)](https://packagist.org/packages/illuminated/testing-tools)

Laravel-specific testing helpers and asserts.

| Laravel | Testing Tools                                                            |
| ------- | :----------------------------------------------------------------------: |
| 5.1.*   | [5.1.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.1) |
| 5.2.*   | [5.2.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.2) |
| 5.3.*   | [5.3.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.3) |
| 5.4.*   | [5.4.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.4) |
| 5.5.*   | [5.5.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.5) |
| 5.6.*   | [5.6.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.6) |
| 5.7.*   | [5.7.*](https://github.com/dmitry-ivanov/laravel-testing-tools/tree/5.7) |

## Usage

1. Install package through `composer`:

    ```shell
    composer require --dev "illuminated/testing-tools:5.7.*"
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

3. Use any of the provided helpers and asserts in your tests:

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

> New helpers are always adding. Feel free to contribute.

- [ApplicationHelpers](#applicationhelpers)
  - [emulateLocal](#emulatelocal)
  - [emulateProduction](#emulateproduction)
  - [emulateEnvironment](#emulateenvironment)
  - [isTravis](#istravis)
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
$this->emulateEnvironment('demo');
```

#### `isTravis()`

Check if tests are running on [Travis CI](https://travis-ci.org) or not:

```php
if ($this->isTravis()) {
    // Yep, it's Travis.
}
```

### ArtisanHelpers

#### `runArtisan()`

Run artisan command by the class name, and return it:

```php
$command = $this->runArtisan(MyCommand::class, ['--name' => 'John']);
```

Also, you can run artisan command by the command object:

```php
$command = $this->runArtisan(new MyCommand, ['--name' => 'Jane']);
```

## Asserts

### ArtisanAsserts

#### `willSeeConfirmation()`

Check if the confirmation is seen during artisan command execution:

```php
$this->willSeeConfirmation('Are you sure?', MyCommand::class);
```

#### `willNotSeeConfirmation()`

Check if the confirmation is not seen during artisan command execution:

```php
$this->willNotSeeConfirmation('Are you sure?', MyCommand::class);
```

#### `willGiveConfirmation()`

Check if the confirmation is seen during artisan command execution, and accept it:

```php
$this->willGiveConfirmation('Are you sure?', MyCommand::class);

$this->seeArtisanOutput('Done!');
```

#### `willNotGiveConfirmation()`

Check if the confirmation is seen during artisan command execution, and refuse it:

```php
$this->willNotGiveConfirmation('Are you sure?', MyCommand::class);

$this->dontSeeArtisanOutput('Done!');
```

#### `seeArtisanOutput()`

Check if the specified string is seen as artisan output:

```php
$this->seeArtisanOutput('Hello, World!');
```

You can pass the path to the text file, containing output:

```php
$this->seeArtisanOutput('correct.output.txt');
```

#### `dontSeeArtisanOutput()`

Check if the specified string is not seen as artisan output:

```php
$this->dontSeeArtisanOutput('Hello, Universe!');
```

You can pass the path to the text file, containing output:

```php
$this->dontSeeArtisanOutput('incorrect.output.txt');
```

#### `seeInArtisanOutput()`

Check if artisan output contains specified string:

```php
$this->seeInArtisanOutput('Hello');
```

You can pass the path to the text file:

```php
$this->seeInArtisanOutput('needle.txt');
```

#### `dontSeeInArtisanOutput()`

Check if artisan output doesn't contain specified string:

```php
$this->dontSeeInArtisanOutput('Universe');
```

You can pass the path to the text file:

```php
$this->dontSeeInArtisanOutput('wrong-needle.txt');
```

#### `seeArtisanTableOutput()`

Check if the specified data is seen as artisan table output:

```php
$this->seeArtisanTableOutput([
    ['System' => 'Node-1', 'Status' => 'Enabled'],
    ['System' => 'Node-2', 'Status' => 'Enabled'],
    ['System' => 'Node-3', 'Status' => 'Enabled'],
]);
```

#### `dontSeeArtisanTableOutput()`

Check if the specified data is not seen as artisan table output:

```php
$this->dontSeeArtisanTableOutput([
    ['System' => 'Node-1', 'Status' => 'Disabled'],
    ['System' => 'Node-2', 'Status' => 'Disabled'],
    ['System' => 'Node-3', 'Status' => 'Disabled'],
]);
```

#### `seeArtisanTableRowsCount()`

Check if the artisan output table rows count equals to the specified value:

```php
$this->seeArtisanTableRowsCount(3);
```

#### `dontSeeArtisanTableRowsCount()`

Check if the artisan output table rows count doesn't equal to the specified value:

```php
$this->dontSeeArtisanTableRowsCount(5);
```

### CollectionAsserts

#### `assertCollectionsEqual()`

Check if passed collections are equal according to the specified key:

```php
$this->assertCollectionsEqual($collection1, $collection2, 'id');
```

#### `assertCollectionsNotEqual()`

Check if passed collections are not equal according to the specified key:

```php
$this->assertCollectionsNotEqual($collection1, $collection2, 'id');
```

### DatabaseAsserts

#### `assertDatabaseHasTable()`

Check if the specified table exists in the database:

```php
$this->assertDatabaseHasTable('users');
```

#### `assertDatabaseMissingTable()`

Check if the specified table doesn't exist in the database:

```php
$this->assertDatabaseMissingTable('unicorns');
```

#### `assertDatabaseHasMany()`

Check if each of the specified rows exists in the database:

```php
$this->assertDatabaseHasMany('posts', [
    ['title' => 'First Post'],
    ['title' => 'Second Post'],
    ['title' => 'Third Post'],
]);
```

#### `assertDatabaseMissingMany()`

Check if each of the specified rows doesn't exist in the database:

```php
$this->assertDatabaseMissingMany('posts', [
    ['title' => 'Fourth Post'],
    ['title' => 'Fifth Post'],
]);
```

### EloquentAsserts

#### `assertEloquentTableEquals()`

Check if an Eloquent model table equals to the specified value:

```php
$this->assertEloquentTableEquals(User::class, 'users');
```

#### `assertEloquentTableNotEquals()`

Check if an Eloquent model table doesn't equal to the specified value:

```php
$this->assertEloquentTableNotEquals(User::class, 'posts');
```

#### `assertEloquentIsIncrementing()`

Check if an Eloquent model has incrementing primary key:

```php
$this->assertEloquentIsIncrementing(Post::class);
```

#### `assertEloquentIsNotIncrementing()`

Check if an Eloquent model has not incrementing primary key:

```php
$this->assertEloquentIsNotIncrementing(Category::class);
```

#### `assertEloquentFillableEquals()`

Check if an Eloquent model fillable fields are equal to the specified value:

```php
$this->assertEloquentFillableEquals(Post::class, ['title', 'publish_at']);
```

#### `assertEloquentFillableNotEquals()`

Check if an Eloquent model fillable fields are not equal to the specified value:

```php
$this->assertEloquentFillableNotEquals(Post::class, ['title', 'body', 'publish_at']);
```

#### `assertEloquentDatesEquals()`

Check if an Eloquent model date fields are equal to the specified value:

```php
$this->assertEloquentDatesEquals(Post::class, ['publish_at', 'created_at', 'updated_at']);
```

#### `assertEloquentDatesNotEquals()`

Check if an Eloquent model date fields are not equal to the specified value:

```php
$this->assertEloquentDatesNotEquals(Post::class, ['publish_at']);
```

#### `assertEloquentTouchesEquals()`

Check if an Eloquent model touched relations are equal to the specified value:

```php
$this->assertEloquentTouchesEquals(Comment::class, ['post']);
```

#### `assertEloquentTouchesNotEquals()`

Check if an Eloquent model touched relations are not equal to the specified value:

```php
$this->assertEloquentTouchesNotEquals(Comment::class, ['user']);
```

#### `assertEloquentHasMany()`

> NOTE: To use this assertion, you have to create model factories for both classes.

Check if an Eloquent model has specified `HasMany` relation:

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

Check if an Eloquent model has `create` method for the specified `HasMany` relation:

```php
$this->assertEloquentHasCreateFor(Post::class, 'comments');
```

Assuming that `Post` class has `createComment` method:

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

Check if an Eloquent model has `createMany` method for the specified `HasMany` relation:

```php
$this->assertEloquentHasCreateManyFor(Post::class, 'comments');
```

Assuming that `Post` class has `createManyComments` method:

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

Check if an Eloquent model has specified `BelongsTo` relation:

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

Add an expectation that exception of the specified class, with the specified message and code, will be thrown:

```php
$this->willSeeException(RuntimeException::class, 'Oops! Houston, we have a problem!');
```

### FilesystemAsserts

#### `assertDirectoryEmpty()`

Check if the specified directory is empty:

```php
$this->assertDirectoryEmpty('./some/folder');
```

#### `assertDirectoryNotEmpty()`

Check if the specified directory is not empty:

```php
$this->assertDirectoryNotEmpty('./some/folder');
```

#### `assertFilesCount()`

Check if the specified directory has the specified files count:

```php
$this->assertFilesCount('./some/folder', 3);
```

#### `assertNotFilesCount()`

Check if the specified directory doesn't have the specified files count:

```php
$this->assertNotFilesCount('./some/folder', 5);
```

### LogFileAsserts

#### `seeLogFile()`

Check if the log file exists by the specified path. Path is relative to the `storage/logs` folder:

```php
$this->seeLogFile('example.log');
```

#### `dontSeeLogFile()`

Check if the log file doesn't exist by the specified path. Path is relative to the `storage/logs` folder:

```php
$this->dontSeeLogFile('foobarbaz.log');
```

#### `seeInLogFile()`

Check if the log file contains the specified content. Path is relative to the `storage/logs` folder.

```php
$this->seeInLogFile('example.log', 'Sample log message!');
```

You can pass an array of expected content items:

```php
$this->seeInLogFile('example.log', [
    'Sample log message 1!',
    'Sample log message 2!',
    'Sample log message 3!',
]);
```

These placeholders are also available for content:
- `%datetime%` - any datetime string.

```php
$this->seeInLogFile('example.log', '[%datetime%]: Sample log message!');
```

#### `dontSeeInLogFile()`

Check if the log file doesn't contain the specified content. Path is relative to the `storage/logs` folder.

```php
$this->dontSeeInLogFile('example.log', 'Unexisting log message!');
```

You can pass an array of unexpected content items:

```php
$this->dontSeeInLogFile('example.log', [
    'Unexisting log message 1!',
    'Unexisting log message 2!',
    'Unexisting log message 3!',
]);
```

### ReflectionAsserts

#### `assertSubclassOf()`

Check that class is a subclass of the specified parent class:

```php
$this->assertSubclassOf(Post::class, Model::class);
```

#### `assertNotSubclassOf()`

Check that class is not a subclass of the specified parent class:

```php
$this->assertNotSubclassOf(Post::class, Command::class);
```

#### `assertTraitUsed()`

Check that class is using the specified trait:

```php
$this->assertTraitUsed(User::class, Notifiable::class);
```

#### `assertTraitNotUsed()`

Check that class is not using the specified trait:

```php
$this->assertTraitNotUsed(Post::class, Notifiable::class);
```

#### `assertMethodExists()`

Check that method exists on the specified object or class name:

```php
$this->assertMethodExists(Post::class, 'save');
```

#### `assertMethodNotExists()`

Check that method doesn't exist on the specified object or class name:

```php
$this->assertMethodNotExists(Post::class, 'fly');
```

### ScheduleAsserts

#### `seeScheduleCount()`

Check that schedule events count equals to the specified:

```php
$this->seeScheduleCount(3);
```

#### `dontSeeScheduleCount()`

Check that schedule events count doesn't equal to the specified:

```php
$this->dontSeeScheduleCount(5);
```

#### `seeInSchedule()`

Check that command is in the schedule. Expressions can be the same as schedule event methods:

```php
$this->seeInSchedule('foo', 'everyFiveMinutes');
$this->seeInSchedule('bar', 'hourly');
$this->seeInSchedule('baz', 'twiceDaily');
```

You can pass pure cron expressions:

```php
$this->seeInSchedule('foo', '*/5 * * * * *');
$this->seeInSchedule('bar', '0 * * * * *');
$this->seeInSchedule('baz', '0 1,13 * * * *');
```

#### `dontSeeInSchedule()`

Check that the command is not in the schedule:

```php
$this->dontSeeInSchedule('foobarbaz');
```

### ServiceProviderAsserts

#### `seeRegisteredAlias()`

Check that the specified alias was successfully registered by the alias loader:

```php
$this->seeRegisteredAlias('Twitter');
```

#### `dontSeeRegisteredAlias()`

Check that the specified alias was not registered by the alias loader:

```php
$this->dontSeeRegisteredAlias('FooBarBaz');
```

#### `seeRegisteredCommand()`

Check that the specified command was successfully registered by the service provider:

```php
$this->seeRegisteredCommand('my-command');
```

#### `dontSeeRegisteredCommand()`

Check that the specified command was not registered by the service provider:

```php
$this->dontSeeRegisteredCommand('foobarbaz');
```

## License

The MIT License. Please see [License File](LICENSE) for more information.

[<img src="https://user-images.githubusercontent.com/1286821/43086829-ff7c006e-8ea6-11e8-8b03-ecf97ca95b2e.png" alt="Support on Patreon" width="125" />](https://www.patreon.com/illuminated)
