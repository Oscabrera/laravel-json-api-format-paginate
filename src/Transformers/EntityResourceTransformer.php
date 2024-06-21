<?php

namespace Oscabrera\JsonApiFormatPaginate\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use ReflectionClass;
use ReflectionException;
use Str;

/**
 * Class JsonApiPaginationTransformer
 *
 * This class represents a JsonApiPaginationTransformer that
 */
class EntityResourceTransformer extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     * @throws ReflectionException
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => new JsonApiResourceTransformer($this->resource),
            'links' => $this->getLinks(),
        ];
    }

    /**
     * Retrieves the links for the resource.
     *
     * @return array{self: string} The links for the resource.
     * @throws ReflectionException
     */
    private function getLinks(): array
    {
        $name = (new ReflectionClass($this->resource))->getShortName();
        $str = new Str();
        $modelName = $str::plural($str::snake($name));

        return [
            'self' => route($modelName . '.read', ['id' => $this->resource->id]),
        ];
    }
}
