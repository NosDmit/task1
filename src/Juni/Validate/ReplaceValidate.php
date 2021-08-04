<?php

namespace App\Juni\Validate;

final class ReplaceValidate implements ValidateInterface
{
    public function format(string $value): array
    {
        $value = str_replace(['.', ','], '', $value);

        return explode(' ', $value);
    }

    public function decode(string $value): string
    {
        return htmlspecialchars_decode($value);
    }
}
