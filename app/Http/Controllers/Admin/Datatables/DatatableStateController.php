<?php
namespace App\Http\Controllers\Admin\Datatables;

use App\Http\Controllers\Controller;
use App\Models\DatatableState;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class DatatableStateController extends Controller
{
    use JsonResponseTrait;

    public function reorder(Request $request, string $id)
    {
        $ids = $request->all();
        $state = DatatableState::where('table_id', $id)->first();
        $cols = $state->column_order;
        foreach ($cols as $key => $value) {
            if($value['index'] === $ids['new_index']) {
                $cols[$key]['index'] = $ids['old_index'];
            } else if ($value['index'] === $ids['old_index']) {
                $cols[$key]['index'] = $ids['new_index'];
            }
        }
        $state->column_order = $cols;
        $state->save();

        return $this->successJsonResponse(__('Pomyślnie zmieniono kolejność kolumn'));
    }
}
