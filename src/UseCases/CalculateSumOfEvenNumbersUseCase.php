<?php

namespace app\UseCases;

use app\Dtos\Request\NumbersRequestDto;
use app\Dtos\Response\SumResponseDto;
use app\Interfaces\CalculatorInterface;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

/**
 * Use Case for calculating sum of even numbers
 */
class CalculateSumOfEvenNumbersUseCase
{
    /**
     * @var CalculatorInterface
     */
    private CalculatorInterface $calculator;

    /**
     * @param CalculatorInterface $calculator
     */
    public function __construct(CalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * Execute the use case
     *
     * @param array $numbers
     * @return SumResponseDto
     * @throws UnknownProperties
     */
    public function execute(array $numbers): SumResponseDto
    {
        $requestDto = new NumbersRequestDto(numbers: $numbers);
        
        return $this->calculator->calculateSumOfEvenNumbers($requestDto);
    }
}
