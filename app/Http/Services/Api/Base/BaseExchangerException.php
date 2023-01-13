<?php
namespace App\Http\Services\Api\Base;

abstract class BaseExchangerException extends \Exception
{
    /**
     * @var array
     */
    private string $typeError = '';

    public function __construct(string $message, string $typeError = '')
    {
        $this->typeError = $typeError ?: $this->typeError;
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