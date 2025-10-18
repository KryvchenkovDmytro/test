<?php

namespace app\Dtos\Response;

use Spatie\DataTransferObject\DataTransferObject;

class SumResponseDto extends DataTransferObject
{
    /**
     * @var int
     */
    public int $sum;

    /**
     * Get sum value
     *
     * @return int
     */
    public function getSum(): int
    {
        return $this->sum;
    }
}
