<?php

namespace App\Juni\Validate;

final class GrepValidate implements ValidateInterface
{
    private $render;
    private $template;

    public function format(string $value): array
    {
        // тут можно написать на preg
        return [];
    }

    public function decode(string $value): string
    {
        return htmlspecialchars_decode($value);
    }
}
