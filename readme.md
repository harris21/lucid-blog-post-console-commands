## Lucid

Read about the [Lucid Architecture Concept](https://medium.com/vine-lab/the-lucid-architecture-concept-ad8e9ed0258f).

## Installation
### 5.3
To start your project with Lucid right away, run the following command:

```
composer create-project lucid-arch/laravel my-project
```

This will give you a Laravel 5.3 installation with Lucid out-of-the-box. If you wish to download other versions of Laravel you may specify it as well:

##### 5.2
```
composer create-project lucid-arch/laravel=5.2.x my-project-5.2
```

> Literally 5.2.x and not 5.2.0 or 5.2.1...

##### 5.1
```
composer create-project lucid-arch/laravel=5.1.x my-project-5.1
```

## Getting Started
This project ships with the [Lucid Console](https://github.com/lucid-architecture/laravel-console) which provides an interactive
user interface and a command line interface that are useful for scaffolding and exploring Services, Features and Jobs.

### Setup
The `lucid` executable will be in `vendor/bin`. If you don't have `./vendor/bin/` as part of your `PATH` you will
need to execute it using `./vendor/bin/lucid`, otherwise add it with the following command to be able to simply
call `lucid`:

```
export PATH="./vendor/bin:$PATH"
```

For a list of all the commands that are available run `lucid` or see the [CLI Reference](#cli-reference).

#### Launching the Interactive Console (UI)

1. Serve Application
One way is to use the built-in server by running:
```bash
php artisan serve
```
> Any other method would also work (Apache, Nginx, etc...)
2. Run `php artisan vendor:publish --provider="Lucid\Console\LucidServiceProvider"`
3. Visit your application at */lucid/dashboard*

### 1. Create a Service

##### CLI
```
lucid make:service Api
```

##### UI



Using one of the methods above, a new service folder must've been created under `src/Services` with the name `Api`.

The **Api** directory will initially contain the following directories:

```
src/Services/Api
├── Console         # Eveything that has to do with the Console (i.e. Commands)
├── Features        # Contains the Api's Features classes
├── Http            # Routes, controllers and middlewares
├── Providers       # Service providers and binding
├── database        # Database migrations and seeders
└── resources       # Assets, Lang and Views
```

One more step is required for Laravel to recognise the service we just created.

#### Register Service

- Open `src/Foundation/Providers/ServiceProvider`
- Add `use App\Services\Api\Providers\ApiServiceProvider`
- In the `register` method add `$this->app->register(ApiServiceProvider::class)`

### 2. Create a Feature

##### CLI
```
lucid make:feature api ListUsers
```

##### UI

Using on of the methods above, the new Feature can be found at `src/Services/Api/Features/ListUsersFeature.php`.
Now you can fill up a bunch of jobs in its `handle` method.

### 3. Create a Job
This project ships with a couple of jobs that can be found in their corresponding domains under `src/Domains`

##### CLI
```
lucid make:job user GetUsers
```

##### UI

Using on of the methods above, the new Job can be found at `src/Domains/User/Jobs/GetUsers` and now you can fill
it with functionality in the `handle` method. For this example we will just add a static `return` statement:

```php
public function handle()
{
    return [
        ['name' => 'John Doe'],
        ['name' => 'Jane Doe'],
        ['name' => 'Tommy Atkins'],
    ];
}
```

### 4. All Together
Back to the Feature we generated earlier, add `$this->run(GetUsersJob)` (remember to `use` the job with the correct
namespace `App\Domains\User\Jobs\GetUsersJob`).

##### Run The Job
In **ListUsersFeature::handle(Request $request)**

```php
public function handle(Request $request)
{
    $users = $this->run(GetUsersJob::class);

    return $this->run(new RespondWithJsonJob($users));
}
```

The `RespondWithJsonJob` is one of the Jobs that were shipped with this project, it lives in the `Http` domain and is
used to respond to a request in JSON format.

##### Expose The Feature
To be able to serve that Feature we need to create a route and a controller that does so.

Generate a plain controller with the following command

```
lucid make:controller api user --plain
```

Add the `get` method to it:

```php
class UserController extends Controller
{
    public function get()
    {
        return $this->serve(ListUsersFeature::class);
    }
}
```

We just need to create a route that would delegate the request to our `get` method:

In `src/Services/Api/Http/routes.php` you will find the route group `Route::group(['prefix' => 'api'], function() {...`
Add the `/users` route within that group.

```php
Route::get('/users', 'UserController@get');
```

Now if you visit `/api/users` you should see the JSON structure.

## CLI Reference
Following are the commands available through the `Lucid` CLI.

- `make:service [name]`: Generate a new Service with the given name
- `make:feature [service] [feature title]`: Generate a new Feature in the given Service
- `make:job [domain] [job title]`: Generate a new Job in the specified Domain (non-existing domains will be created)
- `make:controller [service] [controller name]`: Generate a new Controller in the given Service
- `list:services`: List the existing Services
- `list:features`: List the existing Features, organised by Service
