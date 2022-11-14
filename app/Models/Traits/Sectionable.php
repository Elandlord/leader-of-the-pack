<?php

namespace App\Models\Traits;

trait Sectionable
{
    public function sections()
    {
        return $this->morphMany('App\Models\Section', 'sectionable');
    }
}
