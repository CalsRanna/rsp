# RSP

## About RSP

RSP is a web application library used to make things easy while you want build a plain Laravel application.
Besides, it provides some efficient commands to let you free while you're coding.

RSP is short for **Repository Service and Presenter**.

## How to use

### Installation

You can run `composer require cals/rsp` to install RSP from
[Packagist](https://packagist.org/packages/cals/rsp).

Or, you can add `"cals/rsp": "~2.0"` to your `composer.json` and then run `composer update` in your
terminal to install it.

### Configuration

After you install the RSP, you should put `Cals\RSP\RSPServiceProvider::class` in your
`config/app.php` providers array to make it work.

Then you should run `php artisan vendor:publish --tag=rsp` to publish `rsp.php`.
### Usage

#### Repository

You can use `make:repository` to create a repository and its' interface, or you can create them manually if
you want to. Remember that the repository should extends `Cals\RSP\Repositories\Implementations\Repository`
if you create it manually.

The repository is like below:

```php
<?php

namespace App\Repositories\Implementations;

use App\Models\Example;
use App\Repositories\Interfaces\ExampleRepositoryInterface;
use Cals\RSP\Repositories\Implementations\Repository;

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

As you can see, RSP use Eloquent ORM to operate database, so you should create models to map tables. We
recommend you and only put your models in `app/Models/` instead of `app/` which will make your project more plain.

The repository we extended provides nine methods:

* `store(array $inputs)` You can use it to store data. The type of returned value is subclass of 
`Illuminate\Database\Eloquent\Model`.
* `all()` You can use it to get all records. One thing you should notice is that the type of returned value is
`Illuminate\Database\Eloquent\Collection` rather than `array`.
* `paginate(array $credentials = null, $page, $perPage = 15)` You can use it to paginate records. One thing you should
notice is that the type of returned value is `Illuminate\Pagination\LengthAwarePaginator` rather than `array`.
* `get(array $credentials = null, array $columns = ['*'])` You can use it to get records. One thing you should notice is 
that the type of returned value is `Illuminate\Database\Eloquent\Collection` rather than `array`.
* `getRecordsSortBy(array $credentials = null, array $columns = ['*'], $field = 'id', $asc = true)` You can use it to
get records sort by the field you give. One thing you should notice is that while `$asc` is `true` means the returned
value is ascending sorted otherwise is descending sorted. The other is that the type of returned value is
`Illuminate\Database\Eloquent\Collection` rather than `array`.
* `find(array $credentials = null)` You can use it to find a record which satisfy credentials. The type of 
returned value is subclass of `Illuminate\Database\Eloquent\Model`.
* `update(array $credentials, array $inputs)` You can use it to update data which satisfy credentials. The type of 
returned value is `boolean`.
* `destroy(array $credentials)` You can destroy data which satisfy credentials. The type of returned value is `boolean`.
* `builder(array $credentials = null)` You can use it to create you own method. The type of returned value is 
`Illuminate\Database\Eloquent\Builder`.

> While the returned value has only one record when you use `get(array $columns = ['*'],array $crendentials = null)`,
it is still an instance of `Illuminate\Database\Eloquent\Collection`. So if you want to find only one record and wish
its' type is `Illuminate\Database\Eloquent\Model`, you can use `find(array $credentials = null)` or finish it yourself
using the method `builder()` we provided.

While we use RSP, we do not use repository directly in controller. Repository should always provide methods to let
service to use it.

#### Service

You can use `make:service` to create a service and its' interface, or you can create them manually if you want to. 
Remember that the service should extends
`Cals\RSP\Services\Implementations\Service` if you create it manually.

The service is like below:

```php
<?php

namespace App\Services\Implementations;

use App\Repositories\Interfaces\ExampleRepositoryInterface;
use App\Services\Interfaces\ExampleServiceInterface;
use Cals\RSP\Services\Implementations\Service;

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

The service we extended provides eight methods:

* `store(array $inputs)`
* `all()`
* `paginate(array $credentials = null, $page, $perPage = 15)`
* `get(array $credentials = null, array $columns = ['*'])`
* `getRecordsSortBy(array $credentials = null, array $columns = ['*'], $field = 'id', $asc = true)`
* `find(array $credentials = null)`
* `update(array $credentials, array $inputs)`
* `destroy(array $credentials)`

These eight methods call methods provided by repository simply. So you can override it to satisfy your needs. And the 
type of returned value is like above listed in **Repository**.

#### Presenter

You can use `make:presenter` to create a presenter and its' interface, or you can create them manually if you want to. 
Remember that the presenter should extends `Cals\RSP\Presenters\Implementations\Presenter` if you create it 
manually.

The presenter is like below:

```php
<?php

namespace App\Presenters\Implementations;

use App\Presenters\Interfaces\ExamplePresenterInterface;
use Cals\RSP\Presenters\Implementations\Presenter;

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
