<?php
namespace App\Enums\Workshop;

use App\Enums\EnumInterface;

class PermissionEnum implements EnumInterface
{
    public const WORKERS_CREATE = 1;
    public const WORKERS_READ = 2;
    public const WORKERS_UPDATE = 3;
    public const WORKERS_DELETE = 4;
    public const PERMISSIONS_ADD = 9;
    public const PERMISSIONS_REMOVE = 10;
    public const CLIENTS_CREATE = 11;
    public const CLIENTS_READ = 12;
    public const CLIENTS_UPDATE = 13;
    public const CLIENTS_DELETE = 14;
    public const CLIENTS_REGISTERASUSER = 15;
    public const CLIENTS_REQUESTSHAREDATA = 16;
    public const CARS_CREATE = 17;
    public const CARS_READ = 18;
    public const CARS_UPDATE = 19;
    public const CARS_DELETE = 20;
    public const CARS_ATTACHTOCLIENT = 21;

    public static function getList($id = null)
    {
        $list = [
            self::WORKERS_CREATE => __('Dodawanie pracowników'),
            self::WORKERS_READ => __('Podgląd pracowników'),
            self::WORKERS_UPDATE => __('Edycja pracowników'),
            self::WORKERS_DELETE => __('Usuwanie pracowników'),
            self::PERMISSIONS_ADD => __('Przydzielanie uprawnień pracownikowi'),
            self::PERMISSIONS_REMOVE => __('Usuwanie uprawnień pracownikowi'),
            self::CLIENTS_CREATE => __('Dodawanie klientów'),
            self::CLIENTS_READ => __('Podgląd klientów'),
            self::CLIENTS_UPDATE => __('Edycja klientów'),
            self::CLIENTS_DELETE => __('Usuwanie klientów'),
            self::CLIENTS_REGISTERASUSER => __('Wysyłanie wiadomości e-mail z linkiem do rejestracji klienta'),
            self::CLIENTS_REQUESTSHAREDATA => __('Wysyłanie prośby o udostępnienie danych klienta'),
            self::CARS_CREATE => __('Dodawanie pojazdów'),
            self::CARS_READ => __('Podgląd pojazdów'),
            self::CARS_UPDATE => __('Edycja pojazdów'),
            self::CARS_DELETE => __('Usuwanie pojazdów'),
            self::CARS_ATTACHTOCLIENT => __('Przypisywanie pojazdów do klientów'),
        ];

        if ($id !== null) {
            return isset($list[$id]) ?: null;
        }

        return $list;
    }

}
