<?php

namespace app\Models;

use yii\base\Model;

class NumbersForm extends Model
{
    /**
     * @var array
     */
    public $numbers;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['numbers', 'required', 'message' => 'Numbers array is required'],
            ['numbers', 'validateNumbersArray'],
            ['numbers', 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * Validate that numbers is an array and contains only numeric values
     *
     * @param string $attribute
     */
    public function validateNumbersArray(string $attribute): void
    {
        if (!is_array($this->$attribute)) {
            $this->addError($attribute, 'Numbers must be an array');
            return;
        }

        if (empty($this->$attribute)) {
            $this->addError($attribute, 'Numbers array cannot be empty');
            return;
        }

        foreach ($this->$attribute as $index => $value) {
            if (!is_numeric($value)) {
                $this->addError($attribute, "Value at index {$index} must be numeric");
                return;
            }
        }
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'numbers' => 'Numbers',
        ];
    }
}
