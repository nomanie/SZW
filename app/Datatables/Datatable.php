<?php

namespace App\Datatables;

use Yajra\DataTables\Facades\DataTables;

class Datatable extends Datatables
{
    protected string $model;
    protected $table;
    protected array $rawColumns;
    protected string $deleteRoute;
    protected string $editRoute;

    public function __construct()
    {
        $this->table = DataTables::of((new $this->model)->all());
    }

    public function getTable()
    {
        return $this->table->rawColumns($this->rawColumns)->make(true);
    }

    public function display()
    {
        return $this->getTable();
    }

    public function actionButtons()
    {
        $this->table = $this->table->addColumn('action', function($row){
            $actionBtn = '
<a href="javascript:void(0)" class="edit btn btn-success btn-sm text-white"><i class="fa fa-pencil"></i> Edytuj</a>
<a href="javascript:void(0)" class="delete btn btn-danger btn-sm text-white"><i class="fa fa-trash"></i> Usuń</a>';
            return $actionBtn;
        });
        $this->rawColumns[] = 'action';
    }

    public function addIndexColumn()
    {
        $this->table = $this->table->addIndexColumn();
    }

    public function dropdownAction()
    {
    }

}
