<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Base\BaseApiController;

class ApiController extends BaseApiController
{
    /**
     * Возвращает ответ JsonResponse
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function actionExchanger(Request $request): JsonResponse
    {
        $this->initExchanger($request->mode, $request->data);
        $this->executeExchanger();

        return $this->getResponseExchanger();
    }
}
