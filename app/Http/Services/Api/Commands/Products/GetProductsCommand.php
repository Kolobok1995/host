<?php

namespace App\Http\Services\Api\Products;

/**
 * Интерфейс Команды объявляет 
 * метод для выполнения команд.
 */
class GetProductsCommand extends Command
{
    /**
     * Метод обмена.
     * @var string
     */
    const COMMAND_NAME = 'get_products';

    public function __construct(string $message, string $typeError = null)
    {
        $this->typeError = $typeError;
        parent::__construct($message);
    }

    function execute(): void
    {
        
    }
}
