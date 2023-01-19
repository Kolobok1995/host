<?php

namespace App\Http\Services\Api\Commands\Products;

use App\Http\Services\Api\Base\BaseCommand;
use Illuminate\Http\JsonResponse;

/**
 * Интерфейс Команды объявляет 
 * метод для выполнения команд.
 */
class GetProductsCommand extends BaseCommand
{
    /**
     * Метод обмена.
     * @var string
     */
    const COMMAND_NAME = 'get_products_data';

    public function execute(): mixed
    {
        return \DB::table('users')->get()->toArray();
    }
}