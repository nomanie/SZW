<?php

namespace App\Traits;

use App\Models\System\Workshop;
use Illuminate\Support\Facades\DB;

trait UseTenantConnection
{
    public function __construct()
    {
        if (tenancy()->tenant !== null) {
            $this->table = tenancy()->tenant->tenancy_db_name . '.' . $this->getTable();
        } else if (auth()->user() !== null) {
            $this->table = Workshop::where('identity_id', auth()->user()->id)
                    ->first()->tenancy_db_name . '.' . $this->getTable();
        }
    }
}
