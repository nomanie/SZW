<?php

namespace App\Traits;

use App\Models\System\Workshop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

trait UseSystemConnection
{
    /** Ustawia bazę danych na systemową
     *
     */
    public function __construct()
    {
        $this->table = env('DB_DATABASE') . '.' . $this->table;
    }
}
