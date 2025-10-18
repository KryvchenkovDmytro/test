<?php

namespace app\Resources;

use Yii;

/**
 * Error Resource for formatting error responses
 */
class ErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'success' => false,
            'message' => $this->resource['message'] ?? 'An error occurred',
        ];

        if (isset($this->resource['errors'])) {
            $data['errors'] = $this->resource['errors'];
        }

        if (isset($this->resource['error']) && $this->resource['error'] !== null) {
            $data['error'] = $this->resource['error'];
        }

        return $data;
    }

    /**
     * Create error response with status code
     *
     * @param array $data
     * @param int $statusCode
     * @return array
     */
    public static function makeWithStatus(array $data, int $statusCode = 422): array
    {
        Yii::$app->response->statusCode = $statusCode;
        return static::make($data);
    }

    /**
     * Create validation error response (422)
     *
     * @param array $errors
     * @param string $message
     * @return array
     */
    public static function validation(array $errors, string $message = 'Validation failed'): array
    {
        return static::makeWithStatus([
            'message' => $message,
            'errors' => $errors,
        ]);
    }
}
