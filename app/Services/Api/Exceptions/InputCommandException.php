<?php

namespace App\Services\Api\Exceptions;

use App\Services\Api\Exceptions\Base\BaseExchangerException;

class InputCommandException extends BaseExchangerException
{
    /**
     * @var array
     */
    private string $typeError = 'input_data_error';

    public function __construct(string $message)
    {
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