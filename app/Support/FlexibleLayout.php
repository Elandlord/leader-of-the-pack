<?php

namespace App\Support;

final class FlexibleLayout
{
    private array $attributes;

    public function __construct(private readonly string $name, array $attributes)
    {
        $this->attributes = array_map(
            fn (mixed $value) => $value === '' ? null : $value,
            $attributes,
        );
    }

    public function name(): string
    {
        return $this->name;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
