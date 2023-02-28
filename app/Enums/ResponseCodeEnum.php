<?php
namespace App\Enums;

enum ResponseCodeEnum:int
{
    case OK = 200;
    case CREATE = 201;
    case DELETE = 204;
    case NOTFOUND = 404;
    case BADREQUEST = 400;

    /** Zwraca domyślne wiadomości dla danego kodu
     *
     * @param ResponseCodeEnum $code
     *
     * @return string
     */
    function getDefaultMessages(ResponseCodeEnum $code): string
    {
        return match($code) {
            self::OK => __('Poprawnie zaktualizowano zasoby'),
            self::CREATE => __('Poprawnie dodano zasoby'),
            self::DELETE => __('Poprawnie usunięto zasoby'),
            self::NOTFOUND => __('Nie znaleziono zasobu'),
            self::BADREQUEST => __('Nie prawidłowe dane'),
        };
    }
}
