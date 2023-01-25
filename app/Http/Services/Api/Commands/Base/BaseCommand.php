<?php

namespace App\Http\Services\Api\Commands\Base;

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

    abstract public function execute(): mixed;

    /**
     * Запуск команды
     *
     * @return void
     */
    public function process() 
    {
        $this->data = is_array($this->execute()) ? $this->execute() : [$this->execute()];
    }
    
    /**
     * Возвращает данные запроса
     *
     * @return array
     */
    public function getCommandData(string $key, $default = 'Неизвестно'): string|array
    {
        return $this->hasCommandData($key) ? $this->commandData[$key] : $default;
    }
    
    /**
     * Проверяет наличие параметра в запросе
     *
     * @return array
     */
    public function hasCommandData(string $key, $default = 'Неизвестно'): bool
    {
        return array_key_exists($key, $this->commandData);
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
