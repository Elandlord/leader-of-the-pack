<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'costs',
        'type'
    ];

    /**
     * Get the icon belonging to the price
     *
     * @return Attribute
     */
    protected function icon(): Attribute
    {
        $numberInName = (int)filter_var($this->name, FILTER_SANITIZE_NUMBER_INT);

        if ($numberInName <= 1) {
            $numberInName = 1;
        } elseif ($numberInName > 2) {
            $numberInName = 3;
        }

        return Attribute::make(
            get: fn ($value) => sprintf(
                'icon-%d-dogs',
                $numberInName
            ),
        );
    }
}
