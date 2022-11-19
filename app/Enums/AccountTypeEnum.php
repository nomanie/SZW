<?php
namespace App\Enums;

use App\Enums\EnumInterface;

class AccountTypeEnum implements EnumInterface
{
    public const CLIENT = 1;
    public const WORKSHOP = 2;
    public const DIAGNOSTICIAN = 3;
    public const INSURANCE_AGENT = 4;
    public const ADMIN = 5;
    public const WORKER = 6;

    public static function getList($id = null)
    {
        $list = [
            self::CLIENT => __('Klient'),
            self::WORKSHOP => __('Warsztat'),
            self::DIAGNOSTICIAN => __('Diagnosta'),
            self::INSURANCE_AGENT => __('Agent ubezpieczeniowy'),
            self::ADMIN => __('Admin'),
            self::WORKER => __('Pracownik')
        ];

        if ($id !== null) {
            return isset($list[$id]) ?: null;
        }

        return $list;
    }
}
