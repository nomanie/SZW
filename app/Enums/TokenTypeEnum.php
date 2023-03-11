<?php
namespace App\Enums;

use App\Enums\EnumInterface;

enum TokenTypeEnum:string
{
    case Login = 'Login';
    case Download = 'Download';

}
