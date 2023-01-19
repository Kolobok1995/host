<?php

namespace App\Http\Services\Api\Commands\Products;

use App\Http\Services\Api\Base\BaseCommand;
use Illuminate\Http\JsonResponse;

/**
 * Интерфейс Команды объявляет 
 * метод для выполнения команд.
 */
class GetCategoriesCommand extends BaseCommand
{
    /**
     * Метод обмена.
     * @var string
     */
    const COMMAND_NAME = 'get_categories_data';

    public function execute(): mixed
    {
        if ($this->hasCommandData('slug')) {
            return (array) \DB::table('categories')->where('slug', $this->getCommandData('slug'))->first();
        }

        return \DB::table('categories')->get()->toArray();
    }
}