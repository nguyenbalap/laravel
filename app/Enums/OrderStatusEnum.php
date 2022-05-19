<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatusEnum extends Enum
{
    public const CHO_PHE_DUYET =   0;
    public const CHO_GIAO_HANG =   1;
    public const DANG_GIAO =   2;
    public const HOAN_THANH =   3;
    public const DA_HUY = 4;


    public static function getArrayView()
    {
        return [
            'Chờ phê duyệt' => self::CHO_PHE_DUYET,
            'Chờ giao hàng' => self::CHO_GIAO_HANG,
            'Đang giao' => self::DANG_GIAO,
            'Hoàn Thành' => self::HOAN_THANH,
            'Đã hủy' => self::DA_HUY,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView());
    }
}