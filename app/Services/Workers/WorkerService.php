<?php
namespace App\Services\Workers;

use App\Models\Workers\Worker;

class WorkerService
{
    public function __construct(protected Worker $worker = new Worker())
    {}

    public function save(mixed $data): Worker
    {
        if (isset($data['password'])) {
            $this->worker->password = bcrypt(10, $data['password']);
        } else {
            $this->worker->first_name = $data['first_name'];
            $this->worker->last_name = $data['last_name'];
            $this->worker->email = $data['email'];
            $this->worker->position = $data['position'];
            $this->worker->contract_to = $data['contract_to'];
            $this->worker->contract_from = $data['contract_from'];
            $this->worker->contract_type = $data['contract_type'];
            $this->worker->salary = $data['salary'];
            $this->worker->save();
        }

        return $this->worker;
    }
}
