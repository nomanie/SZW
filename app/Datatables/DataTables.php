<?php
namespace App\Datatables;

use Illuminate\Http\JsonResponse;

class DataTables
{
    protected string $model;
    protected $table;
    protected array $rawColumns = [];

    public function __construct()
    {
        $this->table = \Yajra\DataTables\DataTables::of((new $this->model)->all());
    }

    public function render(): JsonResponse
    {
        return $this->columns()->actionColumn()->rawColumns()->make();
    }

    public function columns(): static
    {

    }

    public function actionColumn(): static
    {
        $this->rawColumns[] = 'actions';
        $this->table = $this->table
            ->addColumn('action', function ($row) {
                return view('global.datatable.dropdown_actions')->with(['row' => $row]);
            });
        return $this;
    }

    public function rawColumns(): static
    {
        $this->table = $this->table->rawColumns($this->rawColumns);
        return $this;
    }

    public function make(): JsonResponse
    {
        return $this->table->make(true);
    }
}
