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
        $evenNumbers = array_filter(
            $dto->getNumbers(),
            fn($num) => $num % 2 === 0
        );

        $sum = array_sum($evenNumbers);

        return new SumResponseDto(sum: $sum);
    }
}
