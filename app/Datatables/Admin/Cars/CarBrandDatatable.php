<?php

namespace App\Datatables\Admin\Cars;

use App\Datatables\Datatable;
use App\Models\System\Cars\CarBrand;

class CarBrandDatatable extends Datatable
{
    protected string $model = CarBrand::class;

    public function builder()
    {
        $this->actionButtons();
        $this->addIndexColumn();
        return $this->display();
    }

}
