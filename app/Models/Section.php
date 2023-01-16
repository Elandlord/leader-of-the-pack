<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Whitecube\NovaFlexibleContent\Concerns\HasFlexible;

class Section extends Model
{
    use SoftDeletes;
    use HasFlexible;

    protected $fillable = [
        'sectionable_id',
        'sectionable_type',
        'content',
    ];

    public function sectionable()
    {
        return $this->morphTo();
    }

    public function getFlexibleImageAttribute()
    {
        $images = $this->toFlexible($this->content)->filter(function ($layout) {
            $attribute = collect($layout->getAttributes())->keys()->filter(function ($key) {
                    return $key === 'image';
                })->count() > 0;

            return $attribute;
        })->map(function ($layout) {
            return $layout->getAttributes();
        })->values();

        $temp = $images->map(function ($image) {
            if ($image['image'] == null) {
                $image['image'] = "assets/img/person-searching.svg";
            } else {
                $image['image'] = '/storage/' . $image['image'];
            }

            return $image;
        });

        return $temp;
    }

    public function getFlexibleButtonAttribute()
    {
        return $this->toFlexible($this->content)->filter(function ($layout) {
            $attribute = collect($layout->getAttributes())->keys()->first();

            return $attribute === 'button';
        })->map(function ($layout) {
            return $layout->getAttributes();
        })->values();
    }

    public function getFlexibleContentAttribute()
    {
        return $this->toFlexible($this->content)->map(function ($layout) {
            $attribute = collect($layout->getAttributes())->keys()->first();
            $value = collect($layout->getAttributes())->first();

            if ($attribute === 'image') {
                if (isset($value)) {
                    $value = "/storage/{$value}";
                } else {
                    $value = '/images/illustrations/illustratie-1.svg';
                }
            }

            return [
                'attribute' => collect($layout->getAttributes())->keys()->first(),
                'value' => $value,
            ];
        })->groupBy('attribute')->map(function ($attributeGroup) {
            $attributeGroup = $attributeGroup->map(function ($attribute) {
                return $attribute['value'];
            });

            if ($attributeGroup->count() === 1) {
                return $attributeGroup->get(0);
            }

            return $attributeGroup;
        });
    }

    public function getFlexibleTitleAttribute()
    {
        $content = $this->flexible_content;

        if (isset($content['title'])) {
            return $content['title'];
        }

        return "";
    }

    public function getFlexibleTextBlockAttribute()
    {
        $content = $this->flexible_content;

        if (isset($content['text_block'])) {
            if (is_string($content['text_block'])) {
                return $content['text_block'];
            }

            return $content['text_block']->get(0);
        }

        return "";
    }
}
