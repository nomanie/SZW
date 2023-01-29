<?php

namespace App\Datatables\Workshop\Documents;

use App\Models\Workshop\Documents\Document;
use App\Datatables\DataTables as BaseDataTables;

class DocumentDataTables extends BaseDataTables
{
    protected string $model = Document::class;
    protected $table;
    protected array $rawColumns = [];
    protected $dropdownType = 2;

    public function __construct(int $client_id = null, int $car_id = null) {
        if ($client_id) {
            $this->query = Document::whereNull('deleted_at')->where('client_id', $client_id)->get();
        } else if ($car_id) {
            $this->query = Document::whereNull('deleted_at')->where('car_id', $car_id)->get();
        } else {
            $this->query = Document::whereNull('deleted_at')->get();
        }
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
                return view('global.datatable.dropdown_actions')->with(['row' => $row, 'type' => $this->dropdownType]);
            });
        return $this;
    }
}
