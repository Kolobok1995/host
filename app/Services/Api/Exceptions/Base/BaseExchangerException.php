<?php
namespace App\Services\Api\Exceptions\Base;

abstract class BaseExchangerException extends \Exception
{
    /**
     * @var array
     */
    private string $typeError = '';

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
        return (string) $this->typeError;
    }
}