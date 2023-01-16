<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MetaTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_taggable_id',
        'meta_taggable_type',
        'name',
        'content',
    ];

    /**
     * @return MorphTo
     * Get the metaTaggable resource that this meta tag belongs to
     */
    public function metaTaggable(): MorphTo
    {
        return $this->morphTo();
    }
}
