<?php

namespace App\Services\Api\Commands\Base;

use App\Services\Api\Commands\Base\BaseContextCommand;

/**
 * Интерфейс Команды объявляет 
 * метод для выполнения команд.
 */
abstract class BaseCommand
{
    public BaseContextCommand $context;
    
    private array $data = [];

    public function __construct(BaseContextCommand $context)
    {
        $this->context = $context;
    }

    /**
     * Процесс команды
     *
     * @return mixed
     */
    abstract public function process(): mixed;

    /**
     * Запуск процесса команды
     *
     * @return void
     */
    public function execute(): void
    {
        $unsafeData = $this->process(); 
        $this->data = is_array($unsafeData) ? $unsafeData : [$unsafeData];
    }

    /**
     * Возвращает данные выполненной команды
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
