<?php

namespace App\Http\Controllers\Base;

use App\Http\Services\Api\ExchangerService;
use App\Http\Services\Api\Commands\Base\BaseContextCommand;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

use App\Http\Services\Api\Exceptions\{
    InitCommandException,
    ExecCommandException
};

class BaseApiController extends BaseController
{
    private ExchangerService $exchanger;
    private BaseContextCommand $contextCommand;

    private array $exchangerError = [];

    /**
     * Инициализируем функционал Обменника
     *
     * @param string $mode
     * @param array $params
     * @return void
     */
    protected function initExchanger($mode, $params): void
    {
        try {
            $this->initContextCommand($mode, $params);
            $this->initExchangerService();
        } catch (InitCommandException $error) {
            $this->exchangerError = [
                'error' => $error->getTypeError(),
                'message' => $error->getMessage()
            ];
        }
    }

    /**
     * Запускаем Обменник
     *
     * @return void
     */
    protected function executeExchanger(): void
    {
        if ($this->exchangerError) {
            return;
        }

        try {
            $this->exchanger->execute();
        } catch (ExecCommandException $error) {
            $this->exchangerError = [
                'error' => $error->getTypeError(),
                'message' => $error->getMessage()
            ];
        }
    }
    
    /**
     * Возвращает ответ в json
     *
     * @return JsonResponse
     */
    public function getResponseExchanger(): JsonResponse
    {
        if ($this->exchangerError) {
            return response()->json([
                'success' => false,
                'data' => $this->exchangerError
            ]);
        }
        
        return response()->json([
            'success' => true,
            'data' =>  $this->exchanger->getData()
        ]);
    }

    /**
     * Инициализация контекста запроса.
     * 
     * @return void
     * @throws ExchangerCommandException
     */
    private function initContextCommand($mode, $params): void
    {
        $this->contextCommand = new BaseContextCommand($mode, $params);
    }

    /**
     * Инициализация обменника.
     * 
     * @return void
     * @throws ExchangerCommandException
     */
    private function initExchangerService(): void
    {
        $this->exchanger = new ExchangerService($this->contextCommand);
    }
}