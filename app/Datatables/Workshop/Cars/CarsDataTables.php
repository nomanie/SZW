<?php

namespace App\Datatables\Workshop\Cars;

use App\Datatables\DataTables as BaseDataTables;
use App\Models\Workshop\Cars\Car;
use App\Models\Workshop\Clients\Client;

class CarsDataTables extends BaseDataTables
{
    protected string $model = Car::class;
    protected $table;
    protected array $rawColumns = [];

    public function __construct(int $client_id = null) {
        if ($client_id === null) {
            $this->query = Car::all();
        } else {
            $this->query = Car::where('client_id', $client_id)->get();
        }
    }
    public function columns(): static
    {
        return $this;
    }
}
