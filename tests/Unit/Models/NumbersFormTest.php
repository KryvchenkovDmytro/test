<?php

namespace tests\Unit\Models;

use app\Models\NumbersForm;
use PHPUnit\Framework\TestCase;

class NumbersFormTest extends TestCase
{
    public function testValidationSuccessWithValidNumbers(): void
    {
        $model = new NumbersForm();
        $model->numbers = [1, 2, 3, 4, 5];

        $result = $model->validate();

        $this->assertTrue($result);
        $this->assertEmpty($model->getErrors());
    }

    public function testValidationFailsWhenNumbersIsEmpty(): void
    {
        $model = new NumbersForm();
        $model->numbers = [];

        $result = $model->validate();

        $this->assertFalse($result);
        $this->assertArrayHasKey('numbers', $model->getErrors());
    }

    public function testValidationFailsWhenNumbersIsNotArray(): void
    {
        $model = new NumbersForm();
        $model->numbers = "not an array";

        $result = $model->validate();

        $this->assertFalse($result);
        $this->assertArrayHasKey('numbers', $model->getErrors());
    }

    public function testValidationFailsWhenNumbersContainsNonNumericValue(): void
    {
        $model = new NumbersForm();
        $model->numbers = [1, 2, "three", 4];

        $result = $model->validate();

        $this->assertFalse($result);
        $this->assertArrayHasKey('numbers', $model->getErrors());
        $this->assertStringContainsString('index 2', $model->getFirstError('numbers'));
    }

    public function testValidationFailsWithFloatNumbers(): void
    {
        $model = new NumbersForm();
        $model->numbers = [1.5, 2.7, 3.9];

        $result = $model->validate();

        $this->assertFalse($result);
        $this->assertArrayHasKey('numbers', $model->getErrors());
    }

    public function testValidationSuccessWithNegativeNumbers(): void
    {
        $model = new NumbersForm();
        $model->numbers = [-1, -2, -3];

        $result = $model->validate();

        $this->assertTrue($result);
    }

    public function testValidationSuccessWithZero(): void
    {
        $model = new NumbersForm();
        $model->numbers = [0, 1, 2];

        $result = $model->validate();

        $this->assertTrue($result);
    }
}
