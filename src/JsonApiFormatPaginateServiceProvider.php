<?php

namespace Oscabrera\JsonApiFormatPaginate;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class JsonApiFormatPaginateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $builder = app(Builder::class);
        $builder::macro('getFields', function () {
            /** @var Builder $this */
            $model = $this->getModel();
            return array_merge($model->getFillable(), $model->getHidden()) ?? [];
        });
    }
}
