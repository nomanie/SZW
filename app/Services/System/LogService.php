<?php

namespace App\Services\System;

use App\Models\System\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogService
{
    protected Log $log;
    public function add(
        $model,
        Request $request,
        int $sender_id = -1,
        array $old_data = [],
        array $new_data = [],
        string $job_name = null
    )
    {
        DB::beginTransaction();
        try {
            $this->log = new Log();
            $this->log->route = $request->route()->getName();
            $this->log->route_type = $request->method();
            $this->log->sender_id = $sender_id;
            $this->log->job_name = $job_name;
            $this->log->old_data = $old_data;
            $this->log->new_data = $new_data;
            $this->log->ip_address = $request->getClientIp();
            $this->log->model_type = class_basename($model);
            $this->log->model_id = $model->id;
            $this->log->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception();
        }
        return true;
    }

    public function remove()
    {
        $this->log->delete();
    }

}
