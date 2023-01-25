<?php

namespace App\Http\Services\Api\Exceptions;

use App\Http\Services\Api\Exceptions\Base\BaseExchangerException;

class InitCommandException extends BaseExchangerException
{
    /**
     * @var array
     */
    private string $typeError = 'input_data_error';

    public function __construct(string $message, string $typeError = '')
    {
        $this->typeError = $typeError;
        parent::__construct($message);
    }

    /**
     * Возвращает тип ошибки
     *
     * @return string
     */
    public function getTypeError(): string
    {
        return $this->typeError;
    }
}