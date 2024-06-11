# Usage

## Installation

1. Composer Dependency:

To leverage the functionalities offered by the `oscabrera/laravel-json-api-format-paginate` package in your Laravel
project, you'll need to install it using Composer, the dependency management tool for PHP. Open your terminal or command
prompt and navigate to your project's root directory. Then, execute the following command:

```shell
composer require oscabrera/laravel-json-api-format-paginate
```

This command instructs Composer to download the `oscabrera/laravel-json-api-format-paginate` package from the Packagist
repository and include it in your project's dependencies.

### Publish the Configuration File:

The configuration file is optional, but provides additional flexibility by allowing you to change the name of the method
used to get the fields from the model. To publish the configuration file, run the following command:

```shell
php artisan vendor:publish --provider="Oscabrera\JsonApiFormatPaginate\JsonApiFormatPaginateServiceProvider" --tag="config"
```

This command will create a `config/json-api-format.php` file in your Laravel application. You can edit this file to adjust
the package settings.

### Configuration File Example

The published configuration file `config/json-api-format.php` will have the following content by default:

```php
return [
    /*
     * The name of the macro that is added to the Eloquent query builder.
     */
    'method_name' => 'getFields',
];
```

### Purpose of Configuration File

The configuration file allows you to change the name of the method that is used to get the fields from the model. By
default, the method is called `getFields`, however, you can change this name depending on your
preferences or project needs.

## Others Configuration Files

### Json Api Paginate Configuration File

if you want to change the configurations of the pagination, you can edit the `config/json-api-paginate.php` file.

```shell
php artisan vendor:publish --provider="Spatie\JsonApiPaginate\JsonApiPaginateServiceProvider" --tag="config"
```

This command will create a `config/json-api-paginate.php` file in your Laravel application. You can edit this file to
adjust the package settings.

### Query Builder Configuration File

if you want to change the configurations of the query builder, you can edit the `config/query-builder.php` file.

```shell
php artisan vendor:publish --provider="Spatie\QueryBuilder\QueryBuilderServiceProvider" --tag="query-builder-config"
```

This command will create a `config/query-builder.php` file in your Laravel application. You can edit this file to adjust
the package settings.