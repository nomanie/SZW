<?php

namespace App\Services\System\Cars;

use App\Models\System\Cars\CarEngine;

class CarEngineService
{
    public function __construct(protected CarEngine $brand = new CarEngine())
    {
    }

    public function save(array $data)
    {
    }

    public function remove(array $data)
    {
    }
}
