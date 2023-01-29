<?php

namespace App\Services\Workshop\Workers;

use App\Enums\AccountTypeEnum;
use App\Models\Workshop\Workers\Worker;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Support\Facades\DB;

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
     * @throws \Exception
     */
    public function saveOrUpdate(array $data, Worker $worker = null): Worker|null
    {
        if ($worker) {
            $this->worker = $worker;
        } else {
            $identity = (new AuthService)->save($data, AccountTypeEnum::WORKER, workshop()->id);
            $this->worker = new Worker();
        }
        DB::beginTransaction();
        try {
            if (!$worker) {
                $this->worker->workshop_id = 1;
                $this->worker->identity_id = $identity->id;
            }
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
