<?php
namespace App\Services\Workshop\Workers;

use App\Models\System\Workshop;
use App\Models\Workshop\Workers\Worker;

class WorkerService
{
    protected Worker $worker;

    public function saveOrUpdate(mixed $data, Worker $worker = null): Worker|null
    {
        $this->worker = new Worker();
        if ($worker) {
            $this->worker = $worker;
        }

        if (isset($data['password'])) {
            $this->worker->password = bcrypt(10, $data['password']);
        }
        $this->worker->workshop_id = 1;
        $this->worker->first_name = $data['first_name'];
        $this->worker->last_name = $data['last_name'];
        $this->worker->login = $data['login'];
        $this->worker->position = $data['position'];
        $this->worker->contract_to = $data['contract_to'];
        $this->worker->contract_from = $data['contract_from'];
        $this->worker->contract_type = $data['contract_type'];
        $this->worker->salary = $data['salary'];
        $this->worker->info = $data['info'];
        $this->worker->save();

        return $this->worker ?? null;
    }
}
