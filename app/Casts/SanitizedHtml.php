<?php

namespace App\Casts;

use App\Support\RichText;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class SanitizedHtml implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value === null ? null : RichText::sanitize($value);
    }
}
