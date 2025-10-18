<?php

namespace tests\Unit\Models;

use app\Models\NumbersForm;
use PHPUnit\Framework\TestCase;

class NumbersFormTest extends TestCase
{
    public function testValidationSuccessWithValidNumbers(): void
    {
        // Arrange
        $model = new NumbersForm();
        $model->numbers = [1, 2, 3, 4, 5];

        // Act
        $result = $model->validate();

        // Assert
        $this->assertTrue($result);
        $this->assertEmpty($model->getErrors());
    }

    public function testValidationFailsWhenNumbersIsEmpty(): void
    {
        // Arrange
        $model = new NumbersForm();
        $model->numbers = [];

        // Act
        $result = $model->validate();

        // Assert
        $this->assertFalse($result);
        $this->assertArrayHasKey('numbers', $model->getErrors());
    }

    public function testValidationFailsWhenNumbersIsNull(): void
    {
        // Arrange
        $model = new NumbersForm();
        $model->numbers = null;

        // Act
        $result = $model->validate();

        // Assert
        $this->assertFalse($result);
        $this->assertArrayHasKey('numbers', $model->getErrors());
    }

    public function testValidationFailsWhenNumbersIsNotArray(): void
    {
        // Arrange
        $model = new NumbersForm();
        $model->numbers = "not an array";

        // Act
        $result = $model->validate();

        // Assert
        $this->assertFalse($result);
        $this->assertArrayHasKey('numbers', $model->getErrors());
    }

    public function testValidationFailsWhenNumbersContainsNonNumericValue(): void
    {
        // Arrange
        $model = new NumbersForm();
        $model->numbers = [1, 2, "three", 4];

        // Act
        $result = $model->validate();

        // Assert
        $this->assertFalse($result);
        $this->assertArrayHasKey('numbers', $model->getErrors());
        $this->assertStringContainsString('index 2', $model->getFirstError('numbers'));
    }

    public function testValidationFailsWithFloatNumbers(): void
    {
        // Arrange
        $model = new NumbersForm();
        $model->numbers = [1.5, 2.7, 3.9];

        // Act
        $result = $model->validate();

        // Assert
        $this->assertFalse($result);
        $this->assertArrayHasKey('numbers', $model->getErrors());
    }

    public function testValidationSuccessWithNegativeNumbers(): void
    {
        // Arrange
        $model = new NumbersForm();
        $model->numbers = [-1, -2, -3];

        // Act
        $result = $model->validate();

        // Assert
        $this->assertTrue($result);
    }

    public function testValidationSuccessWithZero(): void
    {
        // Arrange
        $model = new NumbersForm();
        $model->numbers = [0, 1, 2];

        // Act
        $result = $model->validate();

        // Assert
        $this->assertTrue($result);
    }
}
