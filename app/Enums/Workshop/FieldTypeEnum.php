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
            self::INTEGER => ['label' => __('Liczba'), 'index' => 0],
            self::FLOAT => ['label' => __('Liczba z przecinkiem'), 'index' => 1],
            self::STRING => ['label' => __('Tekst'), 'index' => 2],
            self::TEXTAREA => ['label' => __('Długi tekst'), 'index' => 3],
            self::DATE => ['label' => __('Data'), 'index' => 4]
        ];

        if ($id !== null) {
            return isset($list[$id]) ?: null;
        }

        return $list;
    }

    public static function getType($id = null)
    {
        $list = [
            self::INTEGER => 'number',
            self::FLOAT => 'number',
            self::STRING => 'text',
            self::TEXTAREA => 'textarea',
            self::DATE => 'date'
        ];

        if ($id !== null) {
            return isset($list[$id]) ?: null;
        }

        return $list;
    }

}
