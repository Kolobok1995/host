<?php

namespace App\Http\Services\Api\Commands\Products;

use App\Http\Services\Api\Base\BaseCommand;
use Illuminate\Http\JsonResponse;
use DB;
use Illuminate\Database\Query\Builder;

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

    private Builder $products;

    /**
     * Возвращает array
     *
     * @return mixed
     */
    public function execute(): mixed
    {
        $this->buildProduct();

        if ($this->hasCommandData('category_slug')) {
            $this->productBySlug();
        }

        return $this->getProductList();
    }

    /**
     * @return array
     */
    private function productBySlug(): void
    {
        $this->products = $this->products
            ->leftJoin('categories as c', 'p.category_id', 'c.id')
            ->where('c.slug', $this->getCommandData('category_slug'));
    }
    
    /**
     * @return array
     */
    private function buildProduct(): void
    {
        $this->products = DB::table('products as p')
            ->select([
                'p.id',
                'p.name',
                'pp.price',
                'pp.sale_price'
            ])
            ->leftJoin('product_prices as pp', 'pp.product_id', 'p.id');
    }

    /**
     * @return array
     */
    private function getProductList(): array
    {
        return $this->products
            ->get()
            ->toArray();
    }
}