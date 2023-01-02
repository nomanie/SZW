<?php

namespace App\Datatables\Workshop\Workers;

use App\Enums\Workshop\ContractTypeEnum;
use App\Models\Workshop\Workers\Worker;
use App\Models\Workshop\Workers\WorkerContract;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;
use App\Datatables\DataTables as BaseDataTables;

class WorkerContractDataTables extends BaseDataTables
{
    protected string $model = WorkerContract::class;
    protected $table;
    protected $query;
    protected array $rawColumns = [];

    public function __construct(int $worker_id) {
        $this->query = WorkerContract::where('worker_id', $worker_id)->whereNotNull('archived_at')->get();
    }

    public function editColumns(): static
    {
        $this->table = $this->table->editColumn('contract_type', function (WorkerContract $contract) {
            return ContractTypeEnum::getList($contract->contract_type);
        });
        return $this;
    }
}
