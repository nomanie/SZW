<?php

namespace App\Services\System\Cars;

use App\Models\System\Cars\CarModel;

class CarModelService
{
    public function __construct(protected CarModel $brand = new CarModel())
    {
    }

    public function save(array $data)
    {
    }

    public function remove(array $data)
    {
    }
}
