<?php

namespace App\Http\Services\Api\Base;

/**
 * Интерфейс Команды объявляет 
 * метод для выполнения команд.
 */
abstract class Command
{
    public function __construct(string $message, string $typeError = null)
    {
        $this->typeError = $typeError;
        parent::__construct($message);
    }

    abstract public function execute(): void;
}
