<?php
namespace App\Enums\Workshop;

use App\Enums\EnumInterface;

class MediableTypeEnum implements EnumInterface
{
    public const EXPORT = 0;
    public const INVOICE = 1;

    public static function getList($id = null): array|bool|string|null
    {
        $list = [
            self::EXPORT => 'export',
            self::INVOICE => 'document',
        ];

        if ($id !== null) {
            return $list[$id] ?? null;
        }

        return $list;
    }

    public static function getPath(int $id = null): array|bool|string|null
    {

        $list = [
            self::EXPORT => 'exports/',
            self::INVOICE => 'documents/'
        ];

        if ($id !== null) {
            return $list[$id] ?? null;
        }

        return $list;
    }

}
