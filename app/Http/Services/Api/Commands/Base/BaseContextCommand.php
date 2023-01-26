<?php

namespace App\Http\Services\Api\Commands\Base;

use Illuminate\Http\JsonResponse;
use App\Http\Services\Api\Exceptions\InitCommandException;
use App\Http\Services\Api\Traits\ThrowerError;

class BaseContextCommand extends \Exception
{
    use ThrowerError;

    /**
     * Метод обработки.
     * @var string
     */
    protected string $mode;

    /**
     * Данные для обработки.
     * @var array
     */
    protected array $data;

    public function __construct($mode, $data)
    {
        $this->validate($mode, $data);

        $this->mode = $mode;
        $this->data = $data;
    }

    /**
     * Возвращаем Метод обработки
     *
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * Возвращаем данные
     *
     * @return string
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Проверяет наличие параметра в запросе
     *
     * @return array
     */
    public function hasData(string $key, $default = 'Неизвестно'): bool
    {
        return array_key_exists($key, $this->data);
    }
    
    /**
     * Возвращает значение переданного параметра
     *
     * @return array
     */
    public function getDataValue(string $key, $default = null): array|string|null
    {
        if (! $this->hasData($key)) {
            return $default;
        }
        
        return $this->data[$key];
    }

    /**
     * Проверяем переданные данные
     *
     * @param mixed $mode
     * @param mixed $data
     * @return void
     * @throws InputCommandException
     */
    protected function validate($mode, $data): void 
    {
        if (empty($mode)) {
            $this->throwInputError('Не указан метод обработки');
        }
        
        if (empty($data)) {
            $this->throwInputError('Отсутствуют данные для обработки');
        }
        
        if (! is_string($mode)) {
            $this->throwInputError('Метод должен соответствовать типу string');
        }
        
        if (! is_array($data)) {
            $this->throwInputError('Данные должны соответствовать типу array');
        }
    }
}