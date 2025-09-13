<?php

declare(strict_types=1);

namespace Oscabrera\JsonApiFormatPaginate\Transformers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * Class JsonApiPaginationTransformer
 *
 * This class represents a JsonApiPaginationTransformer that
 */
class JsonApiResourceTransformer extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>|Arrayable|JsonSerializable
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *  Suppress UnusedFormalParameter, because we are using JsonResource
     */
    public function toArray(Request $request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->id ?? null,
            'type' => class_basename($this->resource),
            'attributes' => $this->getAttributes(),
        ];
    }

    /**
     * Get the attributes for the resource.
     *
     * @return array<string, mixed>
     */
    private function getAttributes(): array
    {
        /** @phpstan-ignore-next-line this line is ignored because we are using JsonResource */
        return $this->resource->toArray();
    }
}
