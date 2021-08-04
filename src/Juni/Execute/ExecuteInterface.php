<?php

namespace App\Juni\Execute;

use App\Juni\Validate\ValidateInterface;

interface ExecuteInterface
{
    public function run(string $template, string $render, array $symbols, ValidateInterface $validate): array;
}
