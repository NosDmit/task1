<?php

namespace App\Juni\Execute;

use App\Juni\Execute\Exception\InvalidTemplateException;
use App\Juni\Execute\Exception\ResultTemplateMismatchException;
use App\Juni\Validate\ValidateInterface;

final class Execute implements ExecuteInterface
{
    public const NO_SYMBOLS_IN_TEMPALTE = 0;
    public const TWO_SYMBOLS_IN_TEMPALTE = 2;

    public function run(string $template, string $render, array $symbols, ValidateInterface $validate): array
    {
        $template = $validate->validate($template);
        $render = $validate->validate($render);

        $symbolOpen = $symbols['open'];
        $symbolClose = $symbols['close'];

        if (!$symbolOpen || !$symbolClose) {
            throw new \Exception('Config not valid');
        }

        $variables = [];
        // смотрим разницу между шаблоном и рендером
        // там где она есть в шаблоне ($template) должна быть переменная
        foreach (array_diff($template, $render) as $key => $item) {
            //
            $symbolOpenCount  = substr_count($item, $symbolOpen);
            $symbolCloseCount = substr_count($item, $symbolClose);

            // если нет символов, значит не переменная
            if (self::NO_SYMBOLS_IN_TEMPALTE === $symbolOpenCount || self::NO_SYMBOLS_IN_TEMPALTE === $symbolCloseCount) {
                throw new ResultTemplateMismatchException('Result not matches original template.');
            }

            // если количество открывающих символ не равно закрывающих, то в шаблоне ошибка
            if ($symbolOpenCount != $symbolCloseCount) {
                throw new InvalidTemplateException('Invalid template.');
            }

            $symbolOpen = str_repeat($symbolOpen, $symbolOpenCount);
            $symbolClose = str_repeat($symbolClose, $symbolCloseCount);

            // убираем все символы
            $item = str_replace([$symbolOpen, $symbolClose], '', $item);
            // берем значение их рендера
            $value = $render[$key];
            // если два символа в шаблоне делаем decode
            if (self::TWO_SYMBOLS_IN_TEMPALTE === $symbolOpenCount) {
                $value = $validate->decode($value);
            }

            $variables[$item] = $value;
        }
        return $variables;
    }
}
