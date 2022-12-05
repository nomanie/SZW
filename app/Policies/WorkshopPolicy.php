<?php

namespace App\Policies;

use App\Models\System\User;
use App\Models\Workers\Worker;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Client\Request;

class WorkshopPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function check(Worker $worker)
    {

    }
}
