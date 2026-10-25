<?php

namespace App\Models\Traits;

use App\Support\FlexibleLayout;
use Illuminate\Support\Collection;

trait HasFlexibleContent
{
    public function toFlexible(mixed $value): Collection
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        if (! is_array($value)) {
            return new Collection();
        }

        return (new Collection($value))
            ->filter(fn (mixed $item) => is_array($item) && isset($item['layout']))
            ->map(fn (array $item) => new FlexibleLayout($item['layout'], (array) ($item['attributes'] ?? [])));
    }
}
