<?php

namespace app\Interfaces;

use app\Dtos\Request\NumbersRequestDto;
use app\Dtos\Response\SumResponseDto;

interface CalculatorInterface
{
    /**
     * Calculate sum of even numbers from the given array
     *
     * @param NumbersRequestDto $dto
     * @return SumResponseDto
     */
    public function calculateSumOfEvenNumbers(NumbersRequestDto $dto): SumResponseDto;
}
