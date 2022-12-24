<?php

namespace App\Services\Workshop\Workers;

use App\Models\System\Workshop;
use App\Models\Workshop\Workers\Worker;
use App\Models\Workshop\Workers\WorkerContract;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;
use PHPUnit\Util\Exception;

class WorkerService
{
    protected Worker $worker;

    public function __construct(protected ContractService $contractService)
    {
    }

    /** Tworzy lub edytuje pracownika
     * @param array $data
     * @param Worker|null $worker
     * @return Worker|null
     */
    public function saveOrUpdate(array $data, Worker $worker = null): Worker|null
    {
        if ($worker) {
            $this->worker = $worker;
        } else {
            $this->worker = new Worker();
        }

        if (isset($data['password'])) {
            $this->worker->password = bcrypt(10, $data['password']);
        }
        DB::beginTransaction();
        try {
            $this->worker->workshop_id = 1;
            $this->worker->first_name = $data['first_name'];
            $this->worker->last_name = $data['last_name'];
            $this->worker->login = $data['login'];
            $this->worker->info = $data['info'];
            $this->worker->phone = $data['phone'];
            $this->worker->save();

            if (isset($data['contract_type'])) {
                $this->contractService->save($data, $this->worker->id);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception();
        }

        return $this->worker ?? null;
    }

    /** Archiwizuje pracownika
     * @param int $worker_id
     * @return Worker
     * @throws \Exception
     */
    public function archive(int $worker_id): Worker
    {
        $this->worker = Worker::firstOrNull($worker_id);

        if ($this->worker === null) {
            throw new \Exception();
        }
        $this->worker->is_active = 0;
        $this->worker->save();
        return $this->worker;
    }
}
