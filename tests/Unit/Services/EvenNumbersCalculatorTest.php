<?php

namespace tests\Unit\Services;

use app\Dtos\Request\NumbersRequestDto;
use app\Services\EvenNumbersCalculator;
use PHPUnit\Framework\TestCase;

class EvenNumbersCalculatorTest extends TestCase
{
    private EvenNumbersCalculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new EvenNumbersCalculator();
    }

    public function testCalculateSumOfEvenNumbersWithMixedNumbers(): void
    {
        $dto = new NumbersRequestDto(numbers: [1, 2, 3, 4, 5, 6]);
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        $this->assertEquals(12, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithOnlyEvenNumbers(): void
    {
        $dto = new NumbersRequestDto(numbers: [2, 4, 6, 8]);
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        $this->assertEquals(20, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithOnlyOddNumbers(): void
    {
        $dto = new NumbersRequestDto(numbers: [1, 3, 5, 7]);
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        $this->assertEquals(0, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithEmptyArray(): void
    {
        $dto = new NumbersRequestDto(numbers: []);
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        $this->assertEquals(0, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithNegativeNumbers(): void
    {
        $dto = new NumbersRequestDto(numbers: [-2, -4, 1, 3]);
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);
        
        $this->assertEquals(-6, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithZero(): void
    {
        $dto = new NumbersRequestDto(numbers: [0, 1, 2, 3]);
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        $this->assertEquals(2, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithLargeNumbers(): void
    {
        $dto = new NumbersRequestDto(numbers: [1000, 2000, 3000, 4000]);
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        $this->assertEquals(10000, $result->getSum());
    }
}
