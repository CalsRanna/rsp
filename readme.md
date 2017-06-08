# RSP Architecture

## About RSP Architecture

RSP Architecture is a web application library used to make things easy while you want build a plain Laravel application.
Besides, it provides some efficient commands to let you free while you're coding.

RSP is short for **Repository Service Presenter**.

## How to use

### Installation

You can run `composer require cals/rsp-architecture` to install RSP Architecture from
[Packagist](https://packagist.org/packages/cals/rsp-architecture).

Or, you can add `"cals/rsp-architecture": "1.0"` to your `composer.json` and then run `composer update` in your
terminal to install it.

### Configuration

After you install the RSP Architecture, you should put `Cals\RSPArchitecture\RSPProvider::class` in your
`config/app.php` providers array to make it work.

Then you should run `php artisan vendor:publish --tag=rsp` to publish `rsp.php`.
### Usage

#### Repository

You can use `make:repository` to create a repository and its' interface, or you can create them manually if
you want to. Remember that the repository should extends `Cals\RSPArchitecture\Repositories\Implementations\Repository`
if you create it manually.

The repository is like below:

```php
<?php

namespace App\Repositories\Implementations;

use App\Models\Example;
use App\Repositories\Interfaces\ExampleRepositoryInterface;
use Cals\RSPArchitecture\Repositories\Implementations\Repository;

class ExampleRepository extends Repository implements ExampleRepositoryInterface
{
    /**
     * Get the full name of model.
     *
     * @return mixed
     */
    function model()
    {
        return Example::class;
    }

    // Put your code here...
}

```

And the interface is like below:

```php
<?php

namespace App\Repositories\Interfaces;

interface ExampleRepositoryInterface
{
    // Put your code here...
}

```

As you can see, RSP Architecture use Eloquent ORM to operate database, so you should create models to map tables. We
recommend you put your models in `app/Models/` instead of `app/` which will make your project more plain.

The repository we extended provides five methods:

* `store(array $inputs)` You can use it to store data. The type of returned value is subclass of 
`Illuminate\Database\Eloquent\Model`.
* `get(array $credentials = null, array $columns = ['*'])` You can use it to get data. One thing you should notice is 
that the type of returned value is `Illuminate\Database\Eloquent\Collection` rather than `array`.
* `update(array $inputs, array $credentials)` You can use it to update data which satisfy credentials. The type of 
returned value is `boolean`.
* `destroy(array $credentials)` You can destroy data which satisfy credentials. The type of returned value is `boolean`.
* `builder(array $credentials = null)` You can use it to create you own method. The type of returned value is 
`Illuminate\Database\Eloquent\Builder`.

> While the returned value has only one record when you use `get(array $columns = ['*'],array $crendentials = null)`,
it is still an instance of `Illuminate\Database\Eloquent\Collection`. So if you want to find only one record and wish
its' type is `Illuminate\Database\Eloquent\Model`, you can finish it yourself use the method `builder()` we
provided.

While we use RSP, we do not use repository directly in controller. Repository should always provide methods to let
service use it.

#### Service

You can use `make:service` to create a service and its' interface, or you can create them manually if you want to. 
Remember that the service should extends
`Cals\RSPArchitecture\Services\Implementations\Service` if you create it manually.

The service is like below:

```php
<?php

namespace App\Services\Implementations;

use App\Repositories\Interfaces\ExampleRepositoryInterface;
use App\Services\Interfaces\ExampleServiceInterface;
use Cals\RSPArchitecture\Services\Implementations\Service;

class ExampleService extends Service implements ExampleServiceInterface
{
    /**
     * ExampleService constructor.
     *
     * @param ExampleRepositoryInterface $repository
     */
    public function __construct(ExampleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // Put your code here...
}

```

And the interface is like below:

```php
<?php

namespace App\Services\Interfaces;

interface ExampleServiceInterface
{
    // Put your code here...
}

```

The service we extended provides four methods:

* `store(array $inputs)`
* `get(array $credentials = null, array $columns = ['*'])`
* `update(array $inputs, array $credentials)`
* `destroy(array $credentials)`

These four methods call methods provided by repository simply. So you can override it to satisfy your needs. And the 
type of returned value is like above listed in **Repository**.

#### Presenter

You can use `make:presenter` to create a presenter and its' interface, or you can create them manually if you want to. 
Remember that the presenter should extends `Cals\RSPArchitecture\Presenters\Implementations\Presenter` if you create it 
manually.

The presenter is like below:

```php
<?php

namespace App\Presenters\Implementations;

use App\Presenters\Interfaces\ExamplePresenterInterface;
use Cals\RSPArchitecture\Presenters\Implementations\Presenter;

class ExamplePresenter extends Presenter implements ExamplePresenterInterface
{
    // Put your code here...
}

```

And the interface is like below:

```php
<?php

namespace App\Presenters\Interfaces;

interface ExamplePresenterInterface
{
    // Put your code here...
}

```

The presenter we extended provides two methods:

* `limitLength($field, $length = 40)`
* `differentiateForHumans(Carbon $carbon)`

The first method is used to limit length and the second method is used to show different form the time you give to now.

### Bind

After you create your class, you need put it in `rsp.php`:

```php
<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/8
 * Time: 14:03
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | This array is the list of your repository. The key should be the full
    | name of interface and the value should be the full name of
    | implementation.
    */

    'repositories' => [],

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    |
    | This array is the list of your service. The key should be the full name
    | of interface and the value should be the full name of implementation.
    */

    'services' => [],

    /*
    |--------------------------------------------------------------------------
    | Presenters
    |--------------------------------------------------------------------------
    |
    | This array is the list of your presenter. The key should be the full name
    | of interface and the value should be the full name of implementation.
    */
    'presenters' => []
];
```

Such as:

```php
    'repositories' => [
        'App\Repositories\Interfaces\ExampleRepositoryInterface' => 'App\Repository\Implementations\ExampleRepository'
    ],
```

Then Laravel can bind the interface on the implementation.

### Commands

We provide some commands for you to create files which have some basic codes, and you can put your own code into it to
satisfy your needs.

The commands list below:

* `make:repository` You can use it to create repository class and its' interface.
* `make:service` You can use it to create service class and its' interface.
* `make:presenter` You can use it to create presenter class and its' interface.
* `rsp:generate` You can use it to generate repositories, services and presenters based on registration.

## Contributing

Thank you for considering contributing to the RSP Architecture library!

## Author

Cals Ranna

## License

The RSP Architecture is an open-sourced library licensed under the [MIT license](http://opensource.org/licenses/MIT).
