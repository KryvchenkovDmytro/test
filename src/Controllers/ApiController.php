<?php

namespace app\Controllers;

use app\Models\NumbersForm;
use app\Resources\ErrorResource;
use app\Resources\SumResource;
use app\UseCases\CalculateSumOfEvenNumbersUseCase;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;
use yii\web\Controller;

class ApiController extends Controller
{
    /**
     * Calculate sum of even numbers
     *
     * POST /api/sum-even
     * Body: {"numbers": [1, 2, 3, 4, 5, 6]}
     *
     * @return array
     * @throws InvalidConfigException
     * @throws NotInstantiableException|UnknownProperties
     */
    public function actionSumEven(): array
    {
        $model = new NumbersForm();
        $model->load(Yii::$app->request->getBodyParams(), '');

        if (!$model->validate()) {
            return ErrorResource::validation($model->getErrors());
        }

        $useCase = Yii::$container->get(CalculateSumOfEvenNumbersUseCase::class);
        $responseDto = $useCase->execute($model->numbers);
        return SumResource::make($responseDto);
    }
}
