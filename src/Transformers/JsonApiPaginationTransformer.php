<?php

declare(strict_types=1);

namespace Oscabrera\JsonApiFormatPaginate\Transformers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use JsonSerializable;

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
     * @return array<int|string, mixed>|Arrayable|JsonSerializable
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     * Suppress StaticAccess, because we are using JsonResource
     */
    public function toArray(Request $request): array|Arrayable|JsonSerializable
    {
        if (!$this->resource instanceof LengthAwarePaginator) {
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
     * @return array{
     *     self: string|null,
     *     first: string|null,
     *     last: string|null,
     *     prev: string|null,
     *     next: string|null
     * }
     */
    private static function getLinks(LengthAwarePaginator $paginator): array
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
    private static function getMeta(LengthAwarePaginator $paginator): array
    {
        return [
            'total' => $paginator->total(),
            'per_page' => $paginator->perPage(),
            'to' => $paginator->lastItem(),
            'from' => $paginator->firstItem(),
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'path' => $paginator->path() ?? '',
        ];
    }
}
