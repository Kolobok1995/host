<?php

namespace App\Http\Controllers;

use App\Contracts\Api\ExchangerShop;
use App\Facade\ApiExchanges;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Resources\ApiResource;
use Illuminate\Http\Request;

class ApiShopController extends BaseController
{

    /**
     * Список всех
     *
     * @return ApiResource
     */
    public function index(Request $request, ExchangerShop $service): ApiResource
    {
        return new ApiResource(
            ApiExchanges::getData()
        );
    }
}
