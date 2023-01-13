<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Services\Api\Base\BaseExchangerException;
use App\Http\Services\Api\Base\BaseContextCommand;
use App\Http\Services\Api\ExchangerService;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    private ExchangerService $exchanger;
    private BaseContextCommand $contextCommand;

    public function actionExchanger(Request $request): JsonResponse
    {
        try {
            $this->initContextCommand($request);
            $this->initExchanger();
            $this->processExchanger();
            
        } catch (BaseExchangerException $error) {

            return $this->getJsonResponse([
                'error' => $error->getTypeError(),
                'message' => $error->getMessage()
            ]);
        }

        return $this->getJsonResponse(
            $this->getExchangerJsonData(),
            true
        );
    }

    /**
     * Возвращает ответ в json
     *
     * @param boolean $success
     * @param array $data
     * @return JsonResponse
     */
    private function getJsonResponse(array $data = [], bool $success = false): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'data' => $data
        ]);
    }

   /**
     * Инициализация контекста запроса.
     * 
     * @return void
     * @throws ExchangerCommandException
     */
    protected function initContextCommand(Request $request): void
    {
        $this->contextCommand = new BaseContextCommand(
            $request->mode,
            $request->data
        );
    }
    
    /**
     * Инициализация обменника.
     * 
     * @return void
     * @throws ExchangerCommandException
     */
    protected function initExchanger(): void
    {
        $this->exchanger = new ExchangerService($this->contextCommand);
    }
    
    /**
     * Запуск действий обменника.
     * 
     * @return void
     * @throws ExchangerCommandException
     */
    protected function processExchanger(): void
    {
        $this->exchanger->process();
    }
    
    /**
     * Получение результата обменника.
     * 
     * @return void
     * @throws ExchangerStrategyException
     */
    protected function getExchangerJsonData(): array
    {
        return $this->exchanger->getData();
    }
}
