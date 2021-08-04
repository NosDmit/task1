<?php

namespace Tests\Juni\Validate;

use PHPUnit\Framework\TestCase;
use App\Juni\Juni;
use App\Juni\Validate\ReplaceValidate;

class ReplaceValidateTest extends TestCase
{
    /**
     * @dataProvider testCaseProvider
     */
    public function testJuni(array $expected, string $values): void
    {
        $validate = new ReplaceValidate();
        $this->assertSame($expected, $validate->format($values));
    }

    /**
     * @doesNotPerformAssertions
    */
    public function testCaseProvider(): array
    {
        return [
            [['Hello', 'my', 'name', 'is', 'Juni'],  'Hello, my name is Juni.'],
        ];
    }

}