<?php

namespace App\Services\ApiShop;
use Exception;

class CommandsService
{
    private string $mode;
    private array $data;
    private array $commands;

    public function __construct(array $commands = []) 
    {
        $this->validate();

        $this->mode = request()->mode;
        $this->data = request()->data;
        $this->commands = $commands;
    }

    public function getCommand()
    {
        if (! key_exists($this->mode, $this->commands)) {
            throw new Exception('Invalid command');
        }

        $command = $this->commands[$this->mode];
        
        return new $command($this->data);
    }

    /**
     * Проверяет переданные данные
     *
     * @return void
     */
    private function validate()
    {
        $request = request();

        if (! $request->has('mode')) {
            throw new Exception('Missing mode');
        }

        if (! $request->has('data')) {
            throw new Exception('Missing data');
        }

        if (! is_array($request->data)) {
            throw new Exception('data not array');
        }
    }
}