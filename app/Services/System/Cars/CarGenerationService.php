<?php

namespace App\Services\System\Cars;

use App\Models\System\Cars\CarGeneration;

class CarGenerationService
{
    public function __construct(protected CarGeneration $brand = new CarGeneration())
    {
    }

    public function save(array $data)
    {
    }

    public function remove(array $data)
    {
    }
}
