<?php

namespace App\Juni;

use App\Juni\Execute\ExecuteInterface;
use App\Juni\Validate\ValidateInterface;

final class Juni
{
    private $symbols;
    private $validate;
    private $execute;

    public function __construct(array $symbolForParsing, ValidateInterface $validate, ExecuteInterface $execute)
    {
        $this->symbols = $symbolForParsing;
        $this->validate = $validate;
        $this->execute = $execute;
    }

    public function exec(string $template, string $render): array
    {
        return $this->execute->run($template, $render, $this->symbols, $this->validate);
    }
}
