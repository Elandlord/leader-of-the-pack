<?php

namespace App\Models;

use App\Models\Traits\MetaTaggable;
use App\Models\Traits\Sectionable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Whitecube\NovaFlexibleContent\Concerns\HasFlexible;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;
    use Sectionable;
    use MetaTaggable;
    use HasFlexible;

    protected $fillable = [
        'name',
        'title',
        'route_name',
        'links',
        'show_in_search_results',
    ];

    public function getFlexibleLinksAttribute()
    {
        return $this->toFlexible($this->links);
    }

    public function section(int $number)
    {
        return $this->sections->slice($number - 1, $number)->first();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('supporting_files');
        $this->addMediaCollection('banner_photo_desktop_large')->singleFile();
        $this->addMediaCollection('banner_photo_desktop')->singleFile();
        $this->addMediaCollection('banner_photo_tablet')->singleFile();
        $this->addMediaCollection('banner_photo_mobile')->singleFile();
    }

    public function getBannerPhotoDesktopLargeAttribute(): MediaCollection
    {
        return $this->getMedia('banner_photo_desktop_large');
    }

    public function getBannerPhotoDesktopAttribute(): MediaCollection
    {
        return $this->getMedia('banner_photo_desktop');
    }

    public function getBannerPhotoTabletAttribute(): MediaCollection
    {
        return $this->getMedia('banner_photo_tablet');
    }

    public function getBannerPhotoMobileAttribute(): MediaCollection
    {
        return $this->getMedia('banner_photo_mobile');
    }

    public function getSupportingFilesAttribute(): MediaCollection
    {
        return $this->getMedia('supporting_files');
    }
}
