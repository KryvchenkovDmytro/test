<?php

namespace tests\Unit\Dtos;

use app\Dtos\Response\SumResponseDto;
use PHPUnit\Framework\TestCase;

class SumResponseDtoTest extends TestCase
{
    public function testCreateDto(): void
    {
        $dto = new SumResponseDto(sum: 42);

        $this->assertEquals(42, $dto->getSum());
    }

    public function testToArray(): void
    {
        $dto = new SumResponseDto(sum: 75);
        $result = $dto->toArray();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('sum', $result);
        $this->assertEquals(75, $result['sum']);
    }

    public function testToArrayWithZeroSum(): void
    {
        $dto = new SumResponseDto(sum: 0);
        $result = $dto->toArray();

        $this->assertEquals(['sum' => 0], $result);
    }

    public function testToArrayWithNegativeSum(): void
    {
        $dto = new SumResponseDto(sum: -50);
        $result = $dto->toArray();

        $this->assertEquals(['sum' => -50], $result);
    }
}
