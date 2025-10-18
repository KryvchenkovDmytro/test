<?php

namespace tests\Unit\Dtos;

use app\Dtos\Request\NumbersRequestDto;
use PHPUnit\Framework\TestCase;

class NumbersRequestDtoTest extends TestCase
{
    public function testCreateDtoFromArray(): void
    {
        // Arrange
        $data = ['numbers' => [1, 2, 3, 4, 5]];

        // Act
        $dto = new NumbersRequestDto($data);

        // Assert
        $this->assertInstanceOf(NumbersRequestDto::class, $dto);
        $this->assertEquals([1, 2, 3, 4, 5], $dto->getNumbers());
    }

    public function testCreateDtoFromArrayWithEmptyNumbers(): void
    {
        // Arrange
        $data = ['numbers' => []];

        // Act
        $dto = new NumbersRequestDto($data);

        // Assert
        $this->assertEquals([], $dto->getNumbers());
    }

    public function testCreateDtoFromArrayWithoutNumbersKey(): void
    {
        // Arrange
        $data = [];

        // Act & Assert
        $this->expectException(\TypeError::class);
        new NumbersRequestDto($data);
    }

    public function testGetNumbers(): void
    {
        // Arrange
        $numbers = [10, 20, 30];
        $dto = new NumbersRequestDto(numbers: $numbers);

        // Act
        $result = $dto->getNumbers();

        // Assert
        $this->assertEquals($numbers, $result);
    }
}
