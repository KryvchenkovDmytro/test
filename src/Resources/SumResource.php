<?php

namespace app\Resources;

use app\Dtos\Response\SumResponseDto;

/**
 * Sum Resource for formatting sum calculation response
 */
class SumResource extends JsonResource
{
    /**
     * @var SumResponseDto
     */
    protected mixed $resource;

    /**
     * Transform the resource into an array
     *
     * @return array
     */
    public function toArray(): array
    {
        /** @var SumResponseDto $this->resource */
        return [
            'sum' => $this->resource->getSum(),
        ];
    }
}
