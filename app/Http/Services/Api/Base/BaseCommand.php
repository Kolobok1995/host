<?php

namespace App\Http\Services\Api\Base;

/**
 * Интерфейс Команды объявляет 
 * метод для выполнения команд.
 */
abstract class BaseCommand
{
    private array $commandData;
    private array $data;

    public function __construct(array $commandData = [])
    {
        $this->commandData = $commandData;
    }

    abstract public function execute(): array;

    /**
     * Запуск команды
     *
     * @return void
     */
    public function process() {
        $this->data = $this->execute();
    }
    
    /**
     * Возвращает данные запроса
     *
     * @return array
     */
    public function getCommandData(string $key, $default = 'Неизвестно'): string
    {
        return array_key_exists($key, $this->commandData) ? $this->commandData[$key] : $this->commandData;
    }
    
    /**
     * Возвращает данные выполненной команды
     *
     * @return array
     */
    public function getResult(): array
    {
        return $this->data;
    }
}
