<?php

namespace App\Juni\Validate;

interface ValidateInterface
{
    public function format(string $value): array;

    public function decode(string $value): string;
}
