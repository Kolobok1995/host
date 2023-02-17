<?php

namespace App\Services\ApiShop\Commands\Base;


/**
 * Интерфейс Команды объявляет 
 * метод для выполнения команд.
 */
abstract class BaseCommand
{
    
    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Возвращает значение переданного параметра
     *
     * @return array
     */
    public function getDataValue(string $key, $default = null): array|string|null
    {
        if (! $this->hasData($key)) {
            return $default;
        }
        
        return $this->data[$key];
    }

    /**
     * Проверяет наличие параметра в запросе
     *
     * @return array
     */
    public function hasData(string $key, $default = 'Неизвестно'): bool
    {
        return array_key_exists($key, $this->data);
    }
}
