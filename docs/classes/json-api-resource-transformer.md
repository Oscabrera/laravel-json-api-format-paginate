### JsonApiResourceTransformer

This class transforms individual resources.

```php
<?php

namespace Oscabrera\JsonApiFormatPaginate\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? null,
            'type' => class_basename($this->resource) ?? 'Unknown',
            'attributes' => $this->resource->toArray(),
        ];
    }
}
```