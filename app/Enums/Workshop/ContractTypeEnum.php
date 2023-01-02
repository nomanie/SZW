<?php

namespace App\Enums\Workshop;

use App\Enums\EnumInterface;
use ReflectionClass;

class ContractTypeEnum implements EnumInterface
{
    public const CONTRACT_WORK = 0;
    public const MANDATE_WORK = 1;
    public const CONTRACT_OF_EMPLOYMENT = 2;
    public const B2B = 3;

    /** Zwraca wszystkie zadeklarowane zmienne
     * @return array
     */
    public static function cases(): array
    {
        return (new ReflectionClass(__CLASS__))->getConstants();
    }

    public static function getList($id = null): bool|array|null|string
    {
        $list = [
            self::CONTRACT_WORK => __('Umowa o dzieło'),
            self::MANDATE_WORK => __('Umowa zlecenie'),
            self::CONTRACT_OF_EMPLOYMENT => __('Umowa o prace'),
            self::B2B => __('B2B')
        ];

        if ($id !== null) {
            return $list[$id] ?? null;
        }

        return $list;
    }
}
