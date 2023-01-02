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
            // Najpierw sprawdzamy czy tenancy jest zalogowany (administratorzy warsztatu)
            $this->table = tenancy()->tenant->tenancy_db_name . '.' . $this->getTable();
        } else if (auth()->user()->worker !== null) {
            // Sprawdzanie czy loguje się pracownik warsztatu
            $this->table = Workshop::where('id', auth()->user()->worker->workshop_id)
                    ->first()->tenancy_db_name . '.' . $this->getTable();
        } else if (auth()->user() !== null) {
            // Sprawdzanie czy loguje się administrator warsztatu, ale tenancy() nie zapisało id
            $this->table = Workshop::where('identity_id', auth()->user()->id)
                    ->first()->tenancy_db_name . '.' . $this->getTable();
        }
//        else if (Session::get('id') !== null) {
//            // Jeśli nie działa sesja auth() to sprawdza czy w sesji jest id
//            $this->table = Workshop::where('identity_id', Session::get('id'))
//                    ->first()->tenancy_db_name . '.' . $this->getTable();
//        }
    }

    /**Zwraca bazę danych danego użytkownika (do użytku przy n:m relacjach)
     * @return string
     */
    public function getDatabase(): string
    {
        return explode('.', $this->table)[0];
    }
}
