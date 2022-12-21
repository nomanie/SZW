<?php
namespace App\Services\Workshop\Workers;

use App\Models\System\Workshop;
use App\Models\Workshop\Workers\Worker;
use App\Models\Workshop\Workers\WorkerContract;
use phpDocumentor\Reflection\Types\Boolean;

class WorkerService
{
    protected Worker $worker;

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
        $this->worker->workshop_id = 1;
        $this->worker->first_name = $data['first_name'];
        $this->worker->last_name = $data['last_name'];
        $this->worker->login = $data['login'];
        $this->worker->info = $data['info'];
        $this->worker->save();

        $this->saveContract($data, $this->worker->id);

        return $this->worker ?? null;
    }

    public function saveContract(array $data, int $worker_id): WorkerContract|bool
    {
        $contract = new WorkerContract();
        $contract->position = $data['position'];
        $contract->contract_to = $data['contract_to'];
        $contract->contract_from = $data['contract_from'];
        $contract->contract_type = $data['contract_type'];
        $contract->salary = $data['salary'];
        $contract->worker_id = $worker_id;
        $contract->save();

        return $contract;
    }

    public function archiveContract(array $data, int $id):WorkerContract|bool
    {
        $contract = WorkerContract::find($id);
        $contract->archived_at = now();
        $contract->save();

        return $contract;
    }
}
