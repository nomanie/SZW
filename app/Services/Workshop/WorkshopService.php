<?php

namespace App\Services\Workshop;

use App\Models\System\User;
use App\Models\Workers\Worker;

class WorkshopService
{
    public function __construct(
        protected User $user = new User()
    )
    {}

    public function save(mixed $data): Worker
    {

    }
}
