<?php

namespace App\Services\Workshop\Workers;

 use App\Models\Workshop\Workers\Worker;
 use App\Models\Workshop\Workers\WorkerContract;
 use Illuminate\Support\Facades\DB;
 use PHPUnit\Util\Exception;

 class ContractService
{
    protected WorkerContract $contract;
    protected Worker $worker;
     /** Tworzy nową umowę dla pracownika
      * @param array $data
      * @param int $worker_id
      * @return WorkerContract
      */
     public function save(array $data, int $worker_id, WorkerContract $workerContract = null): WorkerContract
    {
        $this->worker = Worker::find($worker_id);
        if ($this->workerHasActiveContract() && !$workerContract) {
            $this->archive();
        }
        DB::beginTransaction();
        try {
            if (!$workerContract) {
                $this->contract = new WorkerContract();
            } else {
                $this->contract = $workerContract;
            }

            $this->contract->position = $data['position'];
            $this->contract->contract_to = $data['contract_to'] ?? null;
            $this->contract->contract_from = $data['contract_from'];
            $this->contract->contract_type = $data['contract_type'];
            $this->contract->salary = $data['salary'];
            $this->contract->worker_id = $worker_id;
            $this->contract->save();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            throw new Exception();
        }

        return $this->contract;
    }

     /** Archiwizuje umowę
      * @param array $data
      * @param int $id
      * @return WorkerContract|bool
      */
     public function archive():WorkerContract|bool
     {
         $this->contract = $this->worker->currentContract;
         $this->contract->archived_at = now();
         $this->contract->save();

         return $this->contract;
     }

     /** Sprawdza czy pracownik ma aktywną umowę
      * @return bool
      */
     public function workerHasActiveContract(): bool
     {
         return $this->worker->currentContract?->exists() ?? false;
     }

     public function generate()
     {
         //@todo generowanie umowy z danymi z umowy dla danego pracownika (pdf
     }
}
