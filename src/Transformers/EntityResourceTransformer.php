<?php

declare(strict_types=1);

namespace Oscabrera\JsonApiFormatPaginate\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use ReflectionClass;

/**
 * Class JsonApiPaginationTransformer
 *
 * This class represents a JsonApiPaginationTransformer that
 *
 * @property object{id?: int|string} $resource
 */
class EntityResourceTransformer extends JsonResource
{
    private string $modelName;
    private string $method;

    /**
     * @param array<int|string, mixed>|object $resource
     */
    public function __construct(array|object $resource, ?string $method = null, ?string $modelName = null)
    {
        parent::__construct($resource);
        $this->method = $method ?? $this->getMethod();
        $this->modelName = $modelName ?? $this->defineModelName();
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *  Suppress UnusedFormalParameter, because we are using JsonResource
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
        return [
            'self' => route($this->modelName . '.' . $this->method, ['id' => $this->resource->id ?? '']),
        ];
    }

    /**
     * Gets the method used for handling JSON API requests.
     * If no configuration is provided, the default method is 'read'.
     */
    private function getMethod(): string
    {
        return strval(config('json-api-format.route_method', 'read'));
    }

    /**
     * Gets the name of the model, use resource name as default.
     */
    private function defineModelName(): string
    {
        $name = (new ReflectionClass($this->resource))->getShortName();
        $str = new Str();
        return $str::plural($str::kebab($name));
    }
}
