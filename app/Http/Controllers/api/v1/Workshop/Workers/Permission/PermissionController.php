<?php

namespace App\Http\Controllers\api\v1\Workshop\Workers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Workshop\Workers\Worker;
use App\Services\Workshop\Workers\PermissionService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    use JsonResponseTrait;
    public function __construct(protected PermissionService $service)
    {
    }

    public function index()
    {
        return response()->json($this->service->formatData());
    }

    public function store(Request $request)
    {
        if ($this->service->save($request->all())) {
            return $this->successJsonResponse(__('Pomyślnie przypisano uprawnienia'));
        }
        return $this->errorJsonResponse(__('Nie udało się zapisać uprawnień'));
    }

}
