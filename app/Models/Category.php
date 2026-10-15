<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $casts = ['pharm_cat_desc' => \App\Casts\SanitizedHtml::class];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}

