<?php

namespace app\Services;

use app\Dtos\Request\NumbersRequestDto;
use app\Dtos\Response\SumResponseDto;
use app\Interfaces\CalculatorInterface;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class EvenNumbersCalculator implements CalculatorInterface
{
    /**
     * @inheritDoc
     * @throws UnknownProperties
     */
    public function calculateSumOfEvenNumbers(NumbersRequestDto $dto): SumResponseDto
    {
        $numbers = $dto->getNumbers();
        $sum = 0;

        array_map(function ($item) use(&$sum) {
            $sum += $item % 2 === 0 ? $item : 0;
        }, $numbers);

        return new SumResponseDto(sum: $sum);
    }
}
