# JsonApiPaginationTransformer

This class transforms paginated collections.

```php
<?php

namespace Oscabrera\JsonApiFormatPaginate\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

/**
 * Class JsonApiPaginationTransformer
 *
 * This class represents a JsonApiPaginationTransformer that
 */
class JsonApiPaginationTransformer extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (!$this->resource instanceof AbstractPaginator) {
            return parent::toArray($request);
        }

        return [
            'data' => JsonApiResourceTransformer::collection($this->collection),
            'links' => self::getLinks($this->resource),
            'meta' => self::getMeta($this->resource),
        ];
    }

    /**
     * Returns an array of links for a paginated result.
     *
     * @param AbstractPaginator $paginator
     * @return array{
     *     self: string|null,
     *     first: string|null,
     *     last: string|null,
     *     prev: string|null,
     *     next: string|null
     * }
     */
    private static function getLinks(AbstractPaginator $paginator): array
    {
        return [
            'self' => $paginator->url($paginator->currentPage()),
            'first' => $paginator->url(1),
            'last' => $paginator->url($paginator->lastPage()),
            'prev' => $paginator->previousPageUrl(),
            'next' => $paginator->nextPageUrl(),
        ];
    }

    /**
     * Transform a paginated collection into a JSON:API formatted array.
     *
     * @param AbstractPaginator $paginator
     * @return array{
     *     total: int|null,
     *     per_page: int|null,
     *     to: int|null,
     *     from: int|null,
     *     current_page: int|null,
     *     last_page: int|null,
     *     path: string
     *  }
     */
    private static function getMeta(AbstractPaginator $paginator): array
    {
        return [
            'total' => $paginator->total(),
            'per_page' => $paginator->perPage(),
            'to' => $paginator->lastItem(),
            'from' => $paginator->firstItem(),
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'path' => $paginator->path()
        ];
    }
}
```