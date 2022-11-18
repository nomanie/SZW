<?php
namespace App\Enums\Workshop;

use App\Enums\EnumInterface;

class FieldTypeEnum implements EnumInterface
{
    public const INTEGER = 0;
    public const FLOAT = 1;
    public const STRING = 2;
    public const TEXTAREA = 3;
    public const DATE = 4;

    public static function getList($id = null)
    {
        $list = [
            self::INTEGER => __('Liczba'),
            self::FLOAT => __('Liczba z przecinkiem'),
            self::STRING => __('Tekst'),
            self::TEXTAREA => __('Długi tekst'),
            self::DATE => __('Data')
        ];

        if ($id !== null) {
            return isset($list[$id]) ?: null;
        }

        return $list;
    }

}
