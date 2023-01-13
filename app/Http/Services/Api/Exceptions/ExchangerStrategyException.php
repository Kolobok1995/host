<?php

namespace App\Http\Services\Api\Exceptions;

use App\Http\Services\Api\Base\BaseExchangerException;

class ExchangerStrategyException extends BaseExchangerException
{
    /**
     * @var array
     */
    private string $typeError = 'data_use_error ';

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