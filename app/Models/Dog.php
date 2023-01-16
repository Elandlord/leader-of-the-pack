<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Dog extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'breed',
        'birthyear',
    ];

    /**
     * @return string|null
     */
    public function getPhotoAttribute()
    {
        if ($this->getMedia('dog_photo')->count() === 0) {
            return null;
        }

        $image = $this->getMedia('dog_photo')->first()->getUrl();

        if (empty($image)) {
            return null;
        }

        return $image;
    }

    /**
     * @inheritDoc
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('dog_photo')->singleFile();
    }

    /**
     * @inheritDoc
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}
