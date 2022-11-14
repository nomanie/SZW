<?php

namespace App\Enums;

interface EnumInterface
{
    /**
     * @param int|string|null $id
     * @return mixed
     */
    public static function getList($id = null);
}
