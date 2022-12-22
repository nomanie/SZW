<?php

namespace App\Datatables\Workshop\Workers;

use App\Enums\Workshop\ContractTypeEnum;
use App\Models\Workshop\Workers\Worker;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;
use App\Datatables\DataTables as BaseDataTables;

class WorkerDataTables extends BaseDataTables
{
    protected string $model = Worker::class;
    protected $table;
    protected array $rawColumns = [];

    public function columns(): static
    {
        $this->table = $this->table->addColumn('salary', function (Worker $worker) {
            return $worker->currentContract->salary;
        })
            ->addColumn('position', function (Worker $worker) {
                return $worker->currentContract->position;
            })
            ->addColumn('contract_from', function (Worker $worker) {
                return $worker->currentContract->contract_from;
            })
            ->addColumn('contract_to', function (Worker $worker) {
                return $worker->currentContract->contract_to;
            })
            ->addColumn('contract_type', function (Worker $worker) {
                return ContractTypeEnum::getList($worker->currentContract->contract_type);
            })
            ->addColumn('salary', function (Worker $worker) {
                return $worker->currentContract->salary;
            });

        return $this;
    }
}
