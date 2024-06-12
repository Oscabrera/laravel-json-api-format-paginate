# Using the QueryBuilder

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

the method is called `getFields`, use properties `$fillable` and `$hidden` in your model.