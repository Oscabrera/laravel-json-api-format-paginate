<?php

namespace Oscabrera\JsonApiFormatPaginate\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
     */
    private function getLinks(): array
    {
        $modelName = strtolower(
            strval(
                preg_replace(
                    '/([a-z])([A-Z])/',
                    '$1-$2',
                    class_basename($this->resource),
                    -1
                )
            )
        );

        return [
            'self' => route($modelName . '.read', ['id' => $this->resource->id]),
        ];
    }
}
