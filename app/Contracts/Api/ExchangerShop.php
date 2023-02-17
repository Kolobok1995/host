<?php

namespace App\Contracts\Api;

interface ExchangerShop
{
    /**
     * Возвращает результат 
     * выполнения команды в массиве
     *
     * @return array
     */
    public function getData(): array;
}
