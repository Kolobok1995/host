<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class ApiExchanges extends Facade
{
    /**
     * @see App\Services\ApiShop\ExchangerService
     *
     * @return string
     */
   protected static function getFacadeAccessor(): string
   {
       return 'api.exchanges';
   }
}
