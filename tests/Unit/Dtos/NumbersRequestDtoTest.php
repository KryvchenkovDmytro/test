<?php

namespace tests\Unit\Dtos;

use app\Dtos\Request\NumbersRequestDto;
use PHPUnit\Framework\TestCase;

class NumbersRequestDtoTest extends TestCase
{
    public function testCreateDtoFromArray(): void
    {
        $data = ['numbers' => [1, 2, 3, 4, 5]];
        $dto = new NumbersRequestDto($data);

        $this->assertEquals([1, 2, 3, 4, 5], $dto->getNumbers());
    }

    public function testCreateDtoFromArrayWithEmptyNumbers(): void
    {
        $data = ['numbers' => []];
        $dto = new NumbersRequestDto($data);

        $this->assertEquals([], $dto->getNumbers());
    }
}
