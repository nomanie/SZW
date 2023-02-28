<?php

namespace App\Traits;

 use App\Models\Workshop\Mediable;
 use Illuminate\Database\Eloquent\Relations\MorphToMany;

 trait MediableTrait
{
     public function mediables(): MorphToMany
     {
         //@todo zmienić na morph
         return $this->MorphToMany(Mediable::class, 'mediable');
     }
}
