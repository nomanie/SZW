<?php

namespace App\Traits;

 use App\Models\Workshop\Mediable;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;

 trait MediableTrait
{
     public function mediables(): belongsTo
     {
         return $this->belongsTo(Mediable::class, 'mediable_id');
     }
}
