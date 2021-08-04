<?php

namespace App\Juni\Validate;

interface ValidateInterface
{
    public function validate(string $value): array;

    public function decode(string $value): string;
}
