<?php

namespace App\Services\ApiShop\Commands\Products;

use App\Services\ApiShop\Commands\Base\BaseCommand;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

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

    private string|null $slug = null;

    /**
     * @see BaseCommand
    */
    public function process(): mixed
    {
        $this->slug = $this->getDataValue('category_slug');

        if ($this->slug) {
            return (array) DB::table('categories')
                ->where('slug', $this->slug)
                ->first();
        }

        return DB::table('categories')
            ->get()
            ->toArray();
    }
}