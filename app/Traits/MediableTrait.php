<?php

namespace App\Traits;

 use App\Models\Workshop\Mediable;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;

 trait MediableTrait
{
     public function mediables(): belongsTo
     {
         //@todo zmienić na morph
         return $this->belongsTo(Mediable::class, 'mediable_id');
     }
}
