<?php

namespace App\Models\Traits;

use App\Models\MetaTag;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MetaTaggable
{
    /**
     * Get meta tags of resource
     */
    public function metaTags(): MorphMany
    {
        return $this->morphMany(MetaTag::class, 'meta_taggable');
    }
}
