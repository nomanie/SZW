<?php

namespace App\Http\Controllers\api\v1\Workshop\Workers;

use App\Http\Controllers\Controller;
use App\Models\Workers\Worker;
use Yajra\DataTables\Facades\DataTables;

class WorkerController extends Controller
{
    public function index()
    {
        return Datatables::of(Worker::all())->toJson();
    }
}
