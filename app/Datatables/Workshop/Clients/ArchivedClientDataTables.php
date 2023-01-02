<?php

namespace App\Datatables\Workshop\Clients;

use App\Enums\Workshop\ContractTypeEnum;
use App\Models\Workshop\Clients\Client;
use App\Models\Workshop\Workers\Worker;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;
use App\Datatables\DataTables as BaseDataTables;

class ArchivedClientDataTables extends BaseDataTables
{
    protected string $model = Client::class;
    protected $table;
    protected array $rawColumns = [];
    protected $dropdownType = 1;

    public function __construct() {
        $this->query = Client::whereNotNull('deleted_at')->get();
    }
    public function columns(): static
    {
        return $this;
    }
}
