<?php

namespace App\Services\System\Cars;

use App\Models\System\Cars\CarType;

class CarTypeService
{
    public function __construct(protected CarType $brand = new CarType())
    {
    }

    public function save(array $data)
    {
    }

    public function remove(array $data)
    {
    }
}
