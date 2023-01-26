<?php 

namespace App\Http\Services\Api\Traits;

use App\Http\Services\Api\Exceptions\{
    InputCommandException
};

trait ThrowerError 
{
    /**
     *  Выбрасываем ошибку неправильного ввода данных
     *
     * @param string $message
     * @param string|null $className
     * @return void
     * @throws InputCommandException
     */
    protected function throwInputError(string $message): void
    {
        throw new InputCommandException($message);
    }

}

