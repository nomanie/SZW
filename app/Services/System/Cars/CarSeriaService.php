<?php

namespace App\Services\System\Cars;

use App\Models\System\Cars\CarSeria;

class CarSeriaService
{
    public function __construct(protected CarSeria $brand = new CarSeria())
    {
    }

    public function save(array $data)
    {
    }

    public function remove(array $data)
    {
    }
}
