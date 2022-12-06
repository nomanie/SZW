<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait UseTenantConnection
{
    public function __construct()
    {
        return DB::connection('Warsztat_'. tenancy()->tenant->id);
    }
}
