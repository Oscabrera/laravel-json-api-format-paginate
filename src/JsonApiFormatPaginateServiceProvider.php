<?php

declare(strict_types=1);

namespace Oscabrera\JsonApiFormatPaginate;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as BaseBuilder;
use Illuminate\Support\ServiceProvider;

class JsonApiFormatPaginateServiceProvider extends ServiceProvider
{
    /**
     * Boot the application.
     *
     * This method is called automatically when the application boots.
     *  It publishes the JSON API format configuration file
     * if the application is running in console mode. It also registers the macro for querying models.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/json-api-format.php' => config_path('json-api-format.php'),
            ], 'config');
        }

        $this->registerMacro();
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/json-api-format.php', 'json-api-format');
    }

    /**
     * Register a macro for querying models.
     *
     * This method registers a macro for querying models, allowing to retrieve all the
     * fields (fillable and hidden) of the model.
     */
    protected function registerMacro(): void
    {
        $methodName = config('json-api-format.method_name', 'getFields');
        $macro = function () {
            /** @var EloquentBuilder $this */
            $model = $this->getModel();
            return array_merge($model->getFillable(), $model->getHidden());
        };

        EloquentBuilder::macro($methodName, $macro);
        BaseBuilder::macro($methodName, $macro);
    }
}
