<?php

namespace App\Traits;

use App\Models\System\Workshop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

trait UseTenantConnection
{
    /** Ustawia bazę danych na kliencką
     *
     */
    public function __construct()
    {
        if (tenancy()->tenant !== null) {
            $this->table = tenancy()->tenant->tenancy_db_name . '.' . $this->getTable();
        } else if (auth()->user() !== null) {
            $this->table = Workshop::where('identity_id', auth()->user()->id)
                    ->first()->tenancy_db_name . '.' . $this->getTable();
        } else if (Session::get('id') !== null) {
            $this->table = Workshop::where('identity_id', Session::get('id'))
                    ->first()->tenancy_db_name . '.' . $this->getTable();
        }
    }

    /**Zwraca bazę danych danego użytkownika (do użytku przy n:m relacjach)
     * @return string
     */
    public function getDatabase(): string
    {
        return explode('.', $this->table)[0];
    }
}
