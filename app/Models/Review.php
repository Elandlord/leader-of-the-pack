<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'rating',
        'text',
        'location',
        'type',
        'dog_id',
    ];

    /**
     * Review > Dog BelongsTo relation (one review is about one dog)
     * @return BelongsTo
     */
    public function dog(): BelongsTo
    {
        return $this->belongsTo(Dog::class);
    }

}
