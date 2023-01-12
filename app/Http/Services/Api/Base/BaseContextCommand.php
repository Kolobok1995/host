<?php

namespace App\Http\Services\Api\Base;

class BaseContextCommand extends \Exception
{
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
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * Проверяем переданные значения
     *
     * @param mixed $mode
     * @param mixed $data
     * @return void
     */
    protected function validate($mode, $data) {
        if (empty($mode)) {
            $this->throwError('Не указан метод обработки');
        }
        
        if (empty($data)) {
            $this->throwError('Отсутствуют данные для обработки');
        }
        
        if (! is_string($mode)) {
            $this->throwError('Метод должен соответствовать типу string');
        }
        
        if (! is_array($data)) {
            $this->throwError('Данные должны соответствовать типу array');
        }
    }

    /**
     * Бросает ошибку контекста команды.
     * 
     * @param  string $message
     * @param  mixed $case
     * @throws ExchangerCommandException
     */
    protected function throwError(string $message)
    {
        throw new ExchangerCommandException($message, 'Ошибка входных данных');
    }
}