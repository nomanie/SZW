<?php

namespace App\Policies;

use App\Models\Workshop\Workers\Worker;
use Illuminate\Auth\Access\HandlesAuthorization;

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
