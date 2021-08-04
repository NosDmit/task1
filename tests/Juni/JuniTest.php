<?php

namespace Tests\Juni;

use PHPUnit\Framework\TestCase;
use App\Juni\Juni;
use App\Juni\Execute\Execute;
use App\Juni\Validate\ReplaceValidate;
use App\Juni\Execute\Exception\ResultTemplateMismatchException;
use App\Juni\Execute\Exception\InvalidTemplateException;

class JuniTest extends TestCase
{
    /**
     * @dataProvider testCaseProvider
     */
    public function testJuni(string $template, string $values, $expected): void
    {
        $validate = new ReplaceValidate();
        $execute = new Execute();
        $symbols = ['open' => '{', 'close' => '}'];

        $juni = new Juni($symbols, $validate, $execute);
        $this->assertSame($expected, $juni->exec($template, $values));
    }

    /**
     * @doesNotPerformAssertions
    */
    public function testCaseProvider(): array
    {
        return [
            ['Hello, my name is {{name}}',  'Hello, my name is Juni.',          ['name' => "Juni"]],
            ['Hello, my name is {{name}}.', 'Hello, my name is .',              ['name' => ""]],
            ['Hello, my name is {name}.',   'Hello, my name is <robot>.',       ['name' => "<robot>"]],
            ['Hello, my name is {{name}}.', 'Hello, my name is &lt;robot&gt;.', ['name' => "<robot>"]],
            ['Hello, my name is {name}.',   'Hello, my name is &lt;robot&gt;.', ['name' => "&lt;robot&gt;"]]
        ];
    }

    /**
     * @dataProvider testCaseExceptionProvider
     */
    public function testJuniException(string $template, string $values, $expected, $message)
    {
        $validate = new ReplaceValidate();
        $execute = new Execute();
        $symbols = ['open' => '{', 'close' => '}'];

        $juni = new Juni($symbols, $validate, $execute);

        $this->expectException($expected);
        $this->expectExceptionMessage($message);
        $juni->exec($template, $values);
    }

    /**
     * @doesNotPerformAssertions
    */
    public function testCaseExceptionProvider(): array
    {
        return [
            ['Hello, my name is {{name}.',   'Hello, my name is Juni.',     InvalidTemplateException::class, 'Invalid template.'],
            ['Hello, my name is {name}}.',   'Hello, my name is Juni.',     InvalidTemplateException::class, 'Invalid template.'],
            ['Hello, my name is {{{name}}.', 'Hello, my name is Juni.',     InvalidTemplateException::class, 'Invalid template.'],
            ['Hello, my name is {{name}}.',  'Hello, my lastname is Juni.', ResultTemplateMismatchException::class, 'Result not matches original template.'],
            ['Hello, my name is {{name}}.',  'Hi, your lastname is Juni.',  ResultTemplateMismatchException::class, 'Result not matches original template.'],
            ['Hello, my name is {{name}}.',  'dfgfd, erhfdgh vcxbh is tiyyui.', ResultTemplateMismatchException::class, 'Result not matches original template.'],


        ];
    }
}
