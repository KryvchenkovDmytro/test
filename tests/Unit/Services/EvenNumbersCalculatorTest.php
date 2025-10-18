<?php

namespace tests\Unit\Services;

use app\Dtos\Request\NumbersRequestDto;
use app\Services\EvenNumbersCalculator;
use PHPUnit\Framework\TestCase;
use yii\web\Application;

class EvenNumbersCalculatorTest extends TestCase
{
    private EvenNumbersCalculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new EvenNumbersCalculator();
    }

    private function createApplication(): Application
    {
        return new Application(require dirname(__DIR__, 3) . '/config/web.php');
    }

    public function testCalculateSumOfEvenNumbersWithMixedNumbers(): void
    {
        // Arrange
        $dto = new NumbersRequestDto(numbers: [1, 2, 3, 4, 5, 6]);

        // Act
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        // Assert
        $this->assertEquals(12, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithOnlyEvenNumbers(): void
    {
        // Arrange
        $dto = new NumbersRequestDto(numbers: [2, 4, 6, 8]);

        // Act
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        // Assert
        $this->assertEquals(20, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithOnlyOddNumbers(): void
    {
        // Arrange
        $dto = new NumbersRequestDto(numbers: [1, 3, 5, 7]);

        // Act
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        // Assert
        $this->assertEquals(0, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithEmptyArray(): void
    {
        // Arrange
        $dto = new NumbersRequestDto(numbers: []);

        // Act
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        // Assert
        $this->assertEquals(0, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithNegativeNumbers(): void
    {
        // Arrange
        $dto = new NumbersRequestDto(numbers: [-2, -4, 1, 3]);

        // Act
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        // Assert
        $this->assertEquals(-6, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithFloatNumbersReturnsValidationError(): void
    {
        // Arrange
        $app = $this->createApplication();
        $app->request->setBodyParams(['numbers' => [2.5, 4.0, 6.0, 7.5]]);
        
        $controller = new \app\Controllers\ApiController('api', $app);

        // Act
        $response = $controller->actionSumEven();

        // Assert
        $this->assertFalse($response['success']);
        $this->assertArrayHasKey('errors', $response);
        $this->assertArrayHasKey('numbers', $response['errors']);
        $this->assertEquals(400, $app->response->statusCode);
    }

    public function testCalculateSumOfEvenNumbersWithZero(): void
    {
        // Arrange
        $dto = new NumbersRequestDto(numbers: [0, 1, 2, 3]);

        // Act
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        // Assert
        $this->assertEquals(2, $result->getSum());
    }

    public function testCalculateSumOfEvenNumbersWithLargeNumbers(): void
    {
        // Arrange
        $dto = new NumbersRequestDto(numbers: [1000, 2000, 3000, 4000]);

        // Act
        $result = $this->calculator->calculateSumOfEvenNumbers($dto);

        // Assert
        $this->assertEquals(10000, $result->getSum());
    }
}
