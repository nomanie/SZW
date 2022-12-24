<?php
namespace App\Datatables;

use Illuminate\Http\JsonResponse;

class DataTables
{
    protected string $model;
    protected $table;
    protected array $rawColumns = [];
    protected $query;

    public function getTable(): static
    {
        if ($this->query) {
            $this->table = \Yajra\DataTables\DataTables::of($this->query);
        } else {
            $this->table = \Yajra\DataTables\DataTables::of((new $this->model)->all());
        }
        return $this;
    }

    public function render(): JsonResponse
    {
        return $this->getTable()->columns()->editColumns()->actionColumn()->rawColumns()->make();
    }

    public function columns(): static
    {
        return $this;
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

    public function editColumns(): static
    {
        return $this;
    }
}
