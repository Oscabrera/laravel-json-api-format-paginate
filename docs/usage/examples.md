# Examples

## EntityResourceTransformer

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

## JsonApiResourceTransformer

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

