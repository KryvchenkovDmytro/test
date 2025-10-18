<?php

namespace tests\Unit\Dtos;

use app\Dtos\Response\SumResponseDto;
use PHPUnit\Framework\TestCase;

class SumResponseDtoTest extends TestCase
{
    public function testCreateDto(): void
    {
        // Arrange & Act
        $dto = new SumResponseDto(sum: 42);

        // Assert
        $this->assertInstanceOf(SumResponseDto::class, $dto);
        $this->assertEquals(42, $dto->getSum());
    }

    public function testGetSum(): void
    {
        // Arrange
        $dto = new SumResponseDto(sum: 100);

        // Act
        $result = $dto->getSum();

        // Assert
        $this->assertEquals(100, $result);
    }

    public function testToArray(): void
    {
        // Arrange
        $dto = new SumResponseDto(sum: 75);

        // Act
        $result = $dto->toArray();

        // Assert
        $this->assertIsArray($result);
        $this->assertArrayHasKey('sum', $result);
        $this->assertEquals(75, $result['sum']);
    }

    public function testToArrayWithZeroSum(): void
    {
        // Arrange
        $dto = new SumResponseDto(sum: 0);

        // Act
        $result = $dto->toArray();

        // Assert
        $this->assertEquals(['sum' => 0], $result);
    }

    public function testToArrayWithNegativeSum(): void
    {
        // Arrange
        $dto = new SumResponseDto(sum: -50);

        // Act
        $result = $dto->toArray();

        // Assert
        $this->assertEquals(['sum' => -50], $result);
    }
}
