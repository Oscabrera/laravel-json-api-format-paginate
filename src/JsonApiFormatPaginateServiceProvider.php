<?php

namespace Oscabrera\JsonApiFormatPaginate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class JsonApiFormatPaginateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $model = app(Model::class);
        $model::macro('getFields', function () {
            /** @var Model $this */
            return array_merge($this->getFillable(), $this->getHidden()) ?? [];
        });
    }
}
