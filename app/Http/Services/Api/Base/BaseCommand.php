<?php

namespace App\Http\Api\Commands

/**
 * Интерфейс Команды объявляет 
 * метод для выполнения команд.
 */
interface Command
{
    public function execute(): void;
}
