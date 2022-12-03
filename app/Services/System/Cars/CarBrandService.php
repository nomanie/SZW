<?php

namespace App\Services\System\Cars;

use App\Models\System\Cars\CarBrand;
use App\Services\System\LogService;
use Illuminate\Support\Facades\DB;

class CarBrandService
{
    public function __construct(
        protected CarBrand $brand = new CarBrand()
    )
    {
    }

    public function saveOrUpdate(array $data, CarBrand $brand = null): ?CarBrand
    {
        if ($brand) {
            $this->brand = $brand;
        }
        DB::beginTransaction();
        try {
            $this->brand->name = $data['name'];
            $this->brand->brand_popularity = $data['brand_popularity'];
            $this->brand->save();

            DB::commit();
            return $this->brand;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function remove(array $data)
    {
    }
}
