<?php

namespace App\Traits;

use App\Models\System\Log;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait LogTrait
{
    public function logs(): MorphToMany
    {
        return $this->MorphToMany(Log::class, 'model');
    }
}
