<?php

namespace App\Datatables;

use Yajra\DataTables\Facades\DataTables;

class Datatable extends Datatables
{
    protected string $model;
    protected $table;
    protected array $rawColumns;

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
            $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        });
        $this->rawColumns[] = 'action';
    }

    public function checkboxes()
    {
        $this->table = $this->table->addColumn('checkboxes', function($row){
            $checkbox = '<input type="checkbox" class="form-check" data-id="' . $row['id'] . '"></input>';
            return $checkbox;
        });
        $this->rawColumns[] = 'checkboxes';
    }

    public function addIndexColumn()
    {
        $this->table = $this->table->addIndexColumn();
    }

}
