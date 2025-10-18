<?php

namespace app\Resources;

/**
 * Base JSON Resource class (similar to Laravel's JsonResource)
 */
abstract class JsonResource
{
    /**
     * @var mixed
     */
    protected mixed $resource;

    /**
     * @param mixed $resource
     */
    public function __construct(mixed $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Transform the resource into an array
     *
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * Create a new resource instance
     *
     * @param mixed $resource
     * @return array
     */
    public static function make($resource): array
    {
        return (new static($resource))->toArray();
    }
}
