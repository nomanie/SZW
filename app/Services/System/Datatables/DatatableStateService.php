<?php
namespace App\Services\System\Datatables;

use App\Models\DatatableState;

class DatatableStateService {

    public function __construct() {}

    public function make(array $data): DatatableState
    {
        $state = new DatatableState();
        $state->table_id = $data['table_id'];
        $state->column_order = $data['columns_order'];
        $state->order_by = $data['order_by'];
        $state->search = $data['search'];
        $state->visibility = $data['visibility'];
        $state->save();

        return $state;
    }
}
