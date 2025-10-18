<?php

namespace app\Dtos\Request;

use Spatie\DataTransferObject\DataTransferObject;

class NumbersRequestDto extends DataTransferObject
{
    /**
     * @var array<int>
     */
    public array $numbers;

    /**
     * Get numbers array
     *
     * @return array<int>
     */
    public function getNumbers(): array
    {
        return $this->numbers;
    }
}
