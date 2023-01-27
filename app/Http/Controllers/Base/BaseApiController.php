<?php

namespace App\Http\Controllers\Base;

use App\Services\Api\ExchangerService;
use App\Services\Api\Commands\Base\BaseContextCommand;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

use App\Services\Api\Exceptions\{
    InputCommandException
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
        } catch (InputCommandException $error) {
            $this->exchangerError = [
                'error' => $error->getTypeError(),
                'message' => $error->getMessage()
            ];
        } // ToDo: Сделать вывод всех ошибок
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

        // ToDo: Сделать вывод всех ошибок
        try {
            $this->exchanger->execute();
        } catch (InputCommandException $error) {
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