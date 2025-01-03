# Laravel JSON:API Format Paginate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/oscabrera/laravel-json-api-format-paginate.svg?style=flat-square)](https://packagist.org/packages/oscabrera/laravel-json-api-format-paginate)
[![Total Downloads](https://img.shields.io/packagist/dt/oscabrera/laravel-json-api-format-paginate.svg?style=flat-square)](https://packagist.org/packages/oscabrera/laravel-json-api-format-paginate)

[![VitePress](https://github.com/oscabrera/laravel-json-api-format-paginate/actions/workflows/deploy.yml/badge.svg)](https://github.com/oscabrera/laravel-json-api-format-paginate/actions/workflows/deploy.yml)
[![PHPStan](https://github.com/oscabrera/laravel-json-api-format-paginate/actions/workflows/phpstan.yml/badge.svg)](https://github.com/oscabrera/laravel-json-api-format-paginate/actions/workflows/phpstan.yml)
[![Pint](https://github.com/oscabrera/laravel-json-api-format-paginate/actions/workflows/pint.yml/badge.svg)](https://github.com/oscabrera/laravel-json-api-format-paginate/actions/workflows/pint.yml)
[![PHPMD](https://github.com/oscabrera/laravel-json-api-format-paginate/actions/workflows/phpmd.yml/badge.svg)](https://github.com/oscabrera/laravel-json-api-format-paginate/actions/workflows/phpmd.yml)

[![built with Codeium](https://codeium.com/badges/main)](https://codeium.com)

![laravel-json-api-format-paginate](https://socialify.git.ci/Oscabrera/laravel-json-api-format-paginate/image?language=1&name=1&owner=1&pattern=Floating%20Cogs&theme=Auto)

Please follow the documentation
at [laravel-json-api-format-paginate](https://oscabrera.github.io/laravel-json-api-format-paginate/).

This package provides three classes to respond with Resource and Collection in [JSON:API](https://jsonapi.org/) format.
It simplifies the
transformation of Eloquent models and pagination results into JSON compliant responses.

## Installation

Install the package via Composer:

```shell
composer require oscabrera/laravel-json-api-format-paginate
```

# In the Model:

Is important use properties `$fillable` and `$hidden` in your model.

in `$hidden` you have to add `id` in your model.

```php
protected $hidden = [
        'id',
    ];
```
In `$fillable` you should add all the properties you want to be returned by your model.

## Usage

### EntityResourceTransformer

`EntityResourceTransformer` transforms individual resources into JSON:API format.

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Oscabrera\JsonApiFormatPaginate\Utilities\JsonApiPaginationTransformer;

class UserController extends Controller
{
    public function read(string $id)
    {
        $user = User::query()->where('id', $id)->first();

        return new EntityResourceTransformer($user);
    }
}

```

**Example Result**:

```json
{
  "data": {
    "id": 2,
    "type": "User",
    "attributes": {
      "name": "userOne",
      "email": "userOne@example.com"
    }
  },
  "links": {
    "self": "http://localhost/users/2"
  }
}
```

### JsonApiResourceTransformer

`JsonApiResourceTransformer` transforms individual resources into JSON:API format.

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Oscabrera\JsonApiFormatPaginate\Utilities\JsonApiPaginationTransformer;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\JsonApiPaginate\JsonApiPaginate;

class UserController extends Controller
{
    public function index()
    {
        $fields = $user->getFields();
        $users = QueryBuilder::for(User::class)
            ->allowedFilters($fields)
            ->allowedSorts($fields)
            ->jsonPaginate();

        return new JsonApiPaginationTransformer($users);
    }
}

```

**Example Result**:

```json
{
  "data": [
    {
      "id": 2,
      "type": "User",
      "attributes": {
        "id": 2,
        "name": "1",
        "email": "1",
        "email_verified_at": "2024-05-18 14:53:42",
        "password": "1",
        "remember_token": "1",
        "created_at": "2024-05-18T14:53:42.000000Z",
        "updated_at": "2024-05-18T14:53:42.000000Z"
      }
    }
  ],
  "links": {
    "self": "http://localhost/users?page%5Bsize%5D=1&filter%5Bname%5D=1&page%5Bnumber%5D=1",
    "first": "http://localhost/users?page%5Bsize%5D=1&filter%5Bname%5D=1&page%5Bnumber%5D=1",
    "last": "http://localhost/users?page%5Bsize%5D=1&filter%5Bname%5D=1&page%5Bnumber%5D=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "path": "http://localhost/users",
    "per_page": 1,
    "to": 1,
    "total": 1
  }
}
```

## Integration with Spatie Packages

For filtering and sorting JSON:API responses, it is recommended to use the following Spatie packages:

- spatie/laravel-json-api-paginate: To paginate JSON responses
  Documentation:  [spatie/laravel-json-api-paginate](https://github.com/spatie/laravel-json-api-paginate)

- spatie/laravel-query-builder: To build and apply queries.
  Documentation: [spatie/laravel-query-builder](https://spatie.be/docs/laravel-query-builder/v5/introduction)

## Using the QueryBuilder

To facilitate the use of QueryBuilder, the getFields method is added, which obtains the model columns from the $fillable
and $hidden variables, and merges this data. This allows easy use of methods such as allowedFilters, allowedSorts, among
others.

**example**:

```php
$fields = $user->getFields();
$users = QueryBuilder::for(User::class)
    ->allowedFilters($fields)
    ->allowedSorts($fields)
    ->jsonPaginate();
```

## More Information

For more information, visit the [documentation](https://oscabrera.github.io/laravel-json-api-format-paginate).