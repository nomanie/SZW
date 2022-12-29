<?php

namespace App\Http\Controllers\api\v1\Workshop\Workers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Workshop\Workers\Worker;
use App\Services\System\LogService;
use App\Services\Workshop\Workers\PermissionService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    use JsonResponseTrait;
    public function __construct(
        protected PermissionService $service,
        protected LogService $logService,
    )
    {
    }

    public function index()
    {
        return response()->json($this->service->formatData());
    }

    public function store(Request $request)
    {
        $worker = Worker::find(Session::get('worker_id'));
        $old_permissions = $worker->permissions->pluck('pivot')->pluck('permission_id')->toArray();
        $input = $request->all();
        if ($this->service->save($input, $worker)) {
            $this->logService->add($worker, $request, user()->id, $old_permissions, $input);
            return $this->successJsonResponse(__('Pomyślnie przypisano uprawnienia'));
        }
        return $this->errorJsonResponse(__('Nie udało się zapisać uprawnień'));
    }

}
