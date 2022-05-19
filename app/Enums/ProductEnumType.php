<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductEnumType extends Enum
{
    public const WOMEN =   0;
    public const MEN =   1;
    public const ACCESSORIES = 2;


    public static function getArrayView()
    {
        return [
            'women' => self::WOMEN,
            'men' => self::MEN,
            'accessories' => self::ACCESSORIES,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView());
    }
}